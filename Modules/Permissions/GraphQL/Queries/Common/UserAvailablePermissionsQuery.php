<?php

namespace Modules\Permissions\GraphQL\Queries\Common;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Types\UserPermissionsType;
use Rebing\GraphQL\Support\SelectFields;

class UserAvailablePermissionsQuery extends BaseQuery
{
    public const NAME = 'userAvailablePermissions';

    public function __construct(
        protected PermissionService $permissionService
    )
    {
    }

    public function authorize(mixed $root, array $args, mixed $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return (bool)$this->getAuthUser();
    }

    public function type(): GraphQLType
    {
        return UserPermissionsType::nonNullType();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        $user = $this->getAuthUser();

        return [
            'direct' => $this->permissionService->getDirectPermissionsForUser($user),
            'via_roles' => $this->permissionService->getRolesPermissionsForUser($user),
        ];
    }
}
