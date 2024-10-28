<?php

namespace Modules\Users\GraphQL\Queries\BackOffice;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\Repositories\AbstractBaseRepository;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Types\UserPermissionsType;
use Modules\Users\Models\BaseAuthenticatableUser;
use Rebing\GraphQL\Support\SelectFields;

abstract class BaseListUserPermissionsQuery extends BaseQuery
{
    public const DESCRIPTION = 'List all permissions that granted to specific user';

    public function __construct(
        protected PermissionService $service,
        protected AbstractBaseRepository  $repository
    )
    {
        $this->setAdminGuard();
    }

    public function type(): GraphQLType
    {
        return UserPermissionsType::type();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ]
        ];
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        /**
         * @var BaseAuthenticatableUser $admin
         */
        $admin = $this->repository->findOrFailById($args['id']);

        return [
            'direct' => $this->service->getDirectPermissionsForUser($admin),
            'via_roles' => $this->service->getRolesPermissionsForUser($admin),
        ];
    }
}
