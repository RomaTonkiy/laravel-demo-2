<?php

namespace Modules\Permissions\GraphQL\Mutations\BackOffice\Roles;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Permissions\GraphQL\Types\Inputs\UpdateRoleInput;
use Modules\Permissions\GraphQL\Types\RoleType;
use Modules\Permissions\Permissions\Roles\RolesUpdatePermission;
use Modules\Permissions\Services\DTO\UpdateRolePermissionsDTO;
use Modules\Permissions\Services\PermissionService;
use Rebing\GraphQL\Support\SelectFields;

class UpdateRolesPermissionsMutation extends BaseMutation
{
    public const NAME = 'updateRolesPermissions';

    public function __construct(protected PermissionService $permissionService)
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(app(RolesUpdatePermission::class));
    }

    public function args(): array
    {
        return [
            'roles' => [
                'type' => UpdateRoleInput::nonNullList(),
                'description' => 'Roles to update',
            ],
        ];
    }

    public function type(): Type
    {
        return RoleType::nonNullList();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        $DTOs = array_map(
            fn(array $role) => UpdateRolePermissionsDTO::from([
                'roleId' => $role['id'],
                'permissionsIds' => $role['permissions'],
            ]),
            $args['roles'],
        );

        $this->permissionService->updateRolesPermissions($DTOs);

        return PermissionService::getAvailableRoles($fields->getRelations());
    }
}
