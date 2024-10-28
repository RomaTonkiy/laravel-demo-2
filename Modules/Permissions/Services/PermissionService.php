<?php

namespace Modules\Permissions\Services;

use Illuminate\Support\Collection;
use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\BasePermissionsGroup;
use Modules\Permissions\Models\Permission;
use Modules\Permissions\Models\Role;
use Modules\Permissions\Services\DTO\GroupedGuardDTO;
use Modules\Permissions\Services\DTO\UpdateRolePermissionsDTO;
use Modules\Users\Models\Admin;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;
use Spatie\Permission\Models\Permission as SpatiePermission;

class PermissionService
{
    private Collection $guards;

    private Collection $permissions;

    /**
     * @var Collection<GroupedGuardDTO>
     */
    private Collection $groupedPermissions;

    private bool $permissionsFetched = false;

    public function __construct(bool $fetchPermissions = false)
    {
        $this->guards = Collection::make();
        $this->permissions = Collection::make();
        $this->groupedPermissions = Collection::make();

        $this->getGroupedPermissionsFromConfig($fetchPermissions);
    }

    // region Permissions
    public static function getAllAvailablePermissions(): Collection
    {
        $self = app(self::class, ['fetchPermissions' => true]);

        return $self->getGroupedPermissionsFromConfig(true);
    }

    public function getBasePermissionByModel(Permission $model): ?BasePermission
    {
        $permissionFound = $this->permissions->search(
            fn(BasePermission $permission) => $permission->getName() === $model->name
                && $permission->getGuardName() === $model->guard_name
        );

        return $permissionFound !== false ? $this->permissions->get($permissionFound) : null;
    }

    protected function fillBasePermissionFromModel(BasePermission &$permission): BasePermission
    {
        $permissionsModel = $this->getPermissionModelByBasePermission($permission, $permission->getGuardName());

        $permission->setId($permissionsModel->id);

        return $permission;
    }

    protected function getPermissionModelByBasePermission(BasePermission $permission, string $guard): Permission|SpatiePermission
    {
        return Permission::firstOrCreate([
            'name' => $permission->getName(),
            'guard_name' => $guard,
        ]);
    }

    protected function getGroupedPermissionsFromConfig(
        $fillBasePermissionsFromModel = false,
        ?string $guardToFetch = null
    ): Collection
    {
        if ($this->groupedPermissions->isEmpty()) {
            $guardsWithPermissions = config('permissions_grants');

            $resultGuardsPermissions = collect();

            foreach ($guardsWithPermissions as $guard => $permissionGroups) {
                $currentGuard = GroupedGuardDTO::from([
                    'guardName' => $guard,
                    'groups' => collect(),
                ]);

                foreach ($permissionGroups as $permissionGroup => $permissions) {
                    if (!class_exists($permissionGroup) || !is_subclass_of($permissionGroup, BasePermissionsGroup::class)) {
                        continue;
                    }

                    /**
                     * @var $permissions BasePermission[]
                     */
                    $permissions = array_map(
                        function (string $className) use ($guard) {
                            $class = new $className();
                            $class->setGuardName($guard);
                            return $class;
                        },
                        array_filter(
                            $permissions,
                            fn(string $permission) => class_exists($permission)
                                && is_subclass_of($permission, BasePermission::class)
                        )
                    );

                    foreach ($permissions as $permission) {
                        $this->permissions->push($permission);
                    }


                    $permissionGroup = new $permissionGroup($permissions);

                    $currentGuard->groups[] = $permissionGroup;
                }

                $resultGuardsPermissions->push($currentGuard);
            }

            $this->groupedPermissions = $resultGuardsPermissions;
        }

        if ($fillBasePermissionsFromModel && !$this->permissionsFetched) {
            foreach ($this->groupedPermissions as $guardPermissions) {
                foreach ($guardPermissions->groups as $group) {
                    foreach ($group->getPermissions() as $permission) {
                        $this->fillBasePermissionFromModel($permission);
                    }
                }
            }
        }

        if (!empty($guardToFetch)) {
            return $this->groupedPermissions->filter(
                fn(GroupedGuardDTO $guard) => $guard->guardName === $guardToFetch
            );
        }

        return $this->groupedPermissions;
    }

    // region Permissions for user

    /**
     * @param BaseAuthenticatableUser $user
     * @return Collection<Permission>
     */
    public function getPermissionsForUser(BaseAuthenticatableUser $user): Collection
    {
        return $user->getAllPermissions();
    }

    /**
     * @param BaseAuthenticatableUser $user
     * @return Collection<Permission>
     */
    public function getDirectPermissionsForUser(BaseAuthenticatableUser $user): Collection
    {
        return $user->getDirectPermissions();
    }

    /**
     * @param BaseAuthenticatableUser $user
     * @return Collection<Permission>
     */
    public function getRolesPermissionsForUser(BaseAuthenticatableUser $user): Collection
    {
        return $user->getPermissionsViaRoles();
    }

    public function updatePermissionsForUser(BaseAuthenticatableUser $user, array $permissions): void
    {
        $user->syncPermissions($permissions);
    }

    // endregion
    // endregion

    // region Roles
    // region Roles getters
    /**
     * @return Collection<Role>
     */
    public static function getAvailableRoles(array $relations = []): Collection
    {
        /**
         * @var $roles Collection<Role>
         */
        $roles = collect();

        $self = app(self::class);

        $rolesWithGuards = config('users.roles');

        foreach ($rolesWithGuards as $role => $guard) {
            $roles[] = $self->getRoleByNameAndGuard($role, $guard, $relations);
        }

        return $roles;
    }

    protected function getRoleByNameAndGuard(string $roleName, string $guardName, array $relations = []): Role
    {
        if (array_key_exists('permissions', $relations)) {
            $relations['permissions'] = [];
        }

        return Role::query()->with($relations)->firstOrCreate([
            'name' => $roleName,
            'guard_name' => $guardName,
        ]);
    }

    public function getAdminRole(): Role
    {
        return $this->getRoleByNameAndGuard(Admin::ROLE, Admin::GUARD);
    }

    public function getSuperAdminRole(): Role
    {
        return $this->getRoleByNameAndGuard(Admin::SUPER_ADMIN_ROLE, Admin::GUARD);
    }

    public function getOrganizationRole(): Role
    {
        return $this->getRoleByNameAndGuard(Organization::ROLE, Organization::GUARD);
    }

    public function getTeacherRole(): Role
    {
        return $this->getRoleByNameAndGuard(Teacher::ROLE, Teacher::GUARD);
    }

    public function getUserRole(): Role
    {
        return $this->getRoleByNameAndGuard(User::ROLE, User::GUARD);
    }

    public function getUserParentRole(): Role
    {
        return $this->getRoleByNameAndGuard(UserParent::ROLE, UserParent::GUARD);
    }

    // endregion

    // region Roles setters
    public function setAdminRole(BaseAuthenticatableUser $user): void
    {
        $this->setRole($this->getAdminRole(), $user);
    }

    public function setSuperAdminRole(BaseAuthenticatableUser $user): void
    {
        $this->setRole($this->getSuperAdminRole(), $user);
    }

    public function setOrganizationRole(BaseAuthenticatableUser $user): void
    {
        $this->setRole($this->getOrganizationRole(), $user);
    }

    public function setTeacherRole(BaseAuthenticatableUser $user): void
    {
        $this->setRole($this->getTeacherRole(), $user);
    }

    public function setUserRole(BaseAuthenticatableUser $user): void
    {
        $this->setRole($this->getUserRole(), $user);
    }

    public function setUserParentRole(BaseAuthenticatableUser $user): void
    {
        $this->setRole($this->getUserParentRole(), $user);
    }

    protected function setRole(Role $role, BaseAuthenticatableUser $user): void
    {
        $user->assignRole($role);
    }

    public function updateRolesPermissions(array $DTOs): void
    {
        $DTOs = array_filter($DTOs, fn($DTO) => $DTO instanceof UpdateRolePermissionsDTO);

        foreach ($DTOs as $DTO) {
            $this->updateRolePermissions($DTO);
        }
    }

    public function updateRolePermissions(UpdateRolePermissionsDTO $dto): void
    {
        $role = Role::findOrFail($dto->roleId);
        $role->syncPermissions($dto->permissionsIds);
    }

    // endregion
    // endregion
}
