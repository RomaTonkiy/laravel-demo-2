<?php

namespace Modules\Auth\Traits;

use App\Enums\Messages\AuthorizationMessageEnum;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Modules\Permissions\Interfaces\PermissionInterface;
use Modules\Users\Models\Admin;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;


/**
 * TODO: potentially we can have multiple guards in one request, so we need to check all of them
 *  example: editing of courses by teacher and organization, they both have same permissions but on different guards
 *  so, guard should be array of guards an can() @see can() method should check all of them for each permission provided
 */
trait AuthGuardsTrait
{
    protected string $guard = User::GUARD;
    protected string $authMessage = AuthorizationMessageEnum::UNAUTHORIZED;

    protected ?array $permissions = null;

    public function resetAuthGuard(): void
    {
        $this->guard = User::GUARD;
        $this->authMessage = AuthorizationMessageEnum::UNAUTHORIZED;
    }

    protected function getPermissionsGuard(): array|null
    {
        return $this->permissions;
    }

    /**
     * @param PermissionInterface|PermissionInterface[] $permission
     * @return void
     */
    protected function setPermissionsGuard(PermissionInterface|array $permission): void
    {
        $this->permissions = is_array($permission) ? $permission : [$permission];
    }

    /**
     * @param PermissionInterface[] $permission
     * @param $arguments
     * @return bool
     */
    public function can(array $permission, $arguments = []): bool
    {
        if (!$this->authCheck()) {
            return false;
        }

        $declinedPermissions = [];
        $permissions = array_map(fn(PermissionInterface $p) => $p->getName(), $permission);

        foreach ($permissions as $permission) {
            $isPermissionGranted = $this->user()->can($permission);

            if (!$isPermissionGranted) {
                $declinedPermissions[] = $permission;
            }
        }

        if (!empty($declinedPermissions)) {
            $this->authMessage = AuthorizationMessageEnum::NO_PERMISSION . ': ' . implode(', ', $declinedPermissions);

            return false;
        }

        return true;
    }

    /**
     * Should be used for checking if user authenticated in guard, for getting current guard use getAuthGuard()
     * @param array|string|null $guard
     * @return bool
     * @see getAuthGuard()
     *
     */
    protected function authCheck(array|string $guard = null): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if (is_array($guard)) {
            foreach ($guard as $g) {
                if ($this->getAuthGuard($g)->check()) {
                    return true;
                }
            }
        }

        return $this->getAuthGuard(is_string($guard) ? $guard : $this->guard)->check();
    }

    /**
     * Should be used ONLY for getting auth guard, to check if user authenticated in guard use authCheck()
     * @param string|null $guard
     * @return Guard|StatefulGuard
     * @see authCheck()
     *
     */
    protected function getAuthGuard(string $guard = null): Guard|StatefulGuard
    {
        $guard = $guard ?? $this->guard;

        return Auth::guard($guard);
    }

    protected function normalizePermissionArray(array|string $permission): array
    {
        if (is_array($permission)) {
            return $permission;
        }

        return explode('|', $permission);
    }

    protected function user(string $guard = null): Authenticatable|BaseAuthenticatableUser|null
    {
        return $this->getAuthGuard($guard ?? $this->guard)
            ->user();
    }

    public function getAuthorizationMessage(): string
    {
        return $this->authMessage;
    }

    public function authId(string $guard = null): ?int
    {
        return $this->getAuthGuard($guard ?? $this->guard)->id();
    }

    protected function isAdmin(): bool
    {
        return $this->getAuthGuard(Admin::GUARD)->check();
    }

    protected function isSuperAdmin(): bool
    {
        return $this->getAuthUser()?->hasRole(Admin::SUPER_ADMIN_ROLE) ?? false;
    }

    protected function isOrganization(): bool
    {
        return $this->getAuthGuard(Organization::GUARD)->check();
    }

    protected function isTeacher(): bool
    {
        return $this->getAuthGuard(Teacher::GUARD)->check();
    }

    protected function isUser(): bool
    {
        return $this->getAuthGuard(User::GUARD)->check();
    }

    protected function isUserParent(): bool
    {
        return $this->getAuthGuard(UserParent::GUARD)->check();
    }

    protected function setAdminGuard(): void
    {
        $this->guard = Admin::GUARD;
    }

    protected function setOrganizationGuard(): void
    {
        $this->guard = Organization::GUARD;
    }

    protected function setTeacherGuard(): void
    {
        $this->guard = Teacher::GUARD;
    }

    protected function setUserGuard(): void
    {
        $this->guard = User::GUARD;
    }

    protected function setUserParentGuard(): void
    {
        $this->guard = UserParent::GUARD;
    }

    protected function guest(string $guard = null): bool
    {
        return $this->getAuthGuard($guard ?? $this->guard)->guest();
    }

    protected function getAuthUser(): ?BaseAuthenticatableUser
    {
        $guards = array_keys(config('auth.guards'));

        foreach ($guards as $guard) {
            $user = Auth::guard($guard)
                ->user();

            if ($user instanceof BaseAuthenticatableUser) {
                return $user;
            }
        }

        return null;
    }
}
