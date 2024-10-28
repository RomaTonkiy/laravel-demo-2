<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Abstract;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Permissions\Models\Permission;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Types\UserPermissionsType;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Repositories\BaseAuthenticatableRepositoryInterface;
use Rebing\GraphQL\Support\SelectFields;

class BaseUpdateUserPermissionsMutation extends BaseMutation
{
    public const NAME = 'baseUpdateUserPermissions';

    public function __construct(
        protected PermissionService $service,
        protected BaseAuthenticatableRepositoryInterface $repository
    )
    {
        $this->setAdminGuard();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
                'description' => 'User ID',
            ],
            'permissions' => [
                'type'=> NonNullType::listOf(NonNullType::int()),
                'description' => 'Permissions IDs',
                'rules' => ['array', Rule::exists(Permission::class, 'id')],
            ]
        ];
    }

    public function type(): Type
    {
        return UserPermissionsType::nonNullType();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): array
    {
        /**
         * @var BaseAuthenticatableUser $user
         */
        $user = $this->repository->findOrFailById($args['id']);

        $this->service->updatePermissionsForUser($user, $args['permissions']);

        return [
            'direct' => $this->service->getDirectPermissionsForUser($user),
            'via_roles' => $this->service->getRolesPermissionsForUser($user),
        ];
    }
}
