<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\UserParents;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserUpdateMutation;
use Modules\Users\GraphQL\Types\UserParentType;
use Modules\Users\Permissions\UserParents\UpdateUserParentPermission;
use Modules\Users\Services\UserParents\DTO\UpdateUserParentDTO;
use Modules\Users\Services\UserParents\UserParentsService;
use Spatie\LaravelData\Data;

class UpdateUserParentMutation extends BaseUserUpdateMutation
{
    public const NAME = 'updateUserParent';

    public function __construct(
        UserParentsService $service,
    )
    {
        $this->setPermissionsGuard(app(UpdateUserParentPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return UserParentType::nonNullType();
    }

    public function args(): array
    {
        $args = array_merge([
            'first_name' => NonNullType::string(),
            'last_name' => NonNullType::string(),
            'phone' => NonNullType::string(),
        ], parent::args());

        unset($args['name']);

        return $args;
    }

    protected function getDTO(array $args): Data
    {
        return UpdateUserParentDTO::from([
            'id' => $args['id'],
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'] ?? null,
        ]);
    }
}
