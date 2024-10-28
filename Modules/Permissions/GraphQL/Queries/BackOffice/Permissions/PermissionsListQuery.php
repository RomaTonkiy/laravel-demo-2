<?php

namespace Modules\Permissions\GraphQL\Queries\BackOffice\Permissions;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Permissions\GraphQL\Types\GuardPermissionsType;
use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Services\PermissionService;
use Rebing\GraphQL\Support\SelectFields;

class PermissionsListQuery extends BaseQuery
{
    public const NAME = 'permissionsList';

    public const DESCRIPTION = "List all permissions that available to be granted.
    Depending on the guard that you use to authenticate, you will see guards permissions that are granted to be visible for your guard.
    IMPORTANT: If some specific user or role will need to list granted permissions or update them - they have to have
    access to this query to get right `Guards - Groups - Permissions` tree. Generally, such queries/mutations already
    should be protected with set of permissions including this one.";

    public function __construct()
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(app(ListPermissionsPermission::class));
    }

    public function type(): GraphQLType
    {
        return GuardPermissionsType::nonNullList();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        $visibleGuards = config('permissions.visible_guards', [])[$this->guard] ?? [];

        $groupedPermissions = PermissionService::getAllAvailablePermissions()->toArray();

        return array_filter($groupedPermissions, fn($guard) => in_array($guard['guard_name'], $visibleGuards));
    }
}
