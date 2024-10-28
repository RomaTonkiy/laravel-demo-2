<?php

namespace Modules\Permissions\GraphQL\Queries\BackOffice\Roles;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Collection;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Permissions\GraphQL\Types\RoleType;
use Modules\Permissions\Models\Role;
use Modules\Permissions\Permissions\Roles\RolesListPermission;
use Modules\Permissions\Services\PermissionService;
use Rebing\GraphQL\Support\SelectFields;

class RolesListQuery extends BaseQuery
{
    public const NAME = 'rolesList';

    public function __construct()
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(app(RolesListPermission::class));
    }

    public function type(): GraphQLType
    {
        return RoleType::nonNullList();
    }

    /**
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param ResolveInfo $info
     * @param SelectFields $fields
     * @return Collection<Role>
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): Collection
    {
        return PermissionService::getAvailableRoles($fields->getRelations());
    }
}
