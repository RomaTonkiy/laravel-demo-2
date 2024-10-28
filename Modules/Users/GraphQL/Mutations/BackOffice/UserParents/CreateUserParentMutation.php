<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\UserParents;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserCreateMutation;
use Modules\Users\GraphQL\Types\UserParentType;
use Modules\Users\Permissions\UserParents\CreateUserParentPermission;
use Modules\Users\Services\UserParents\DTO\CreateUserParentDTO;
use Modules\Users\Services\UserParents\UserParentsService;
use Spatie\LaravelData\Data;

class CreateUserParentMutation extends BaseUserCreateMutation
{
    public const NAME = 'createUserParent';

    public function __construct(
        UserParentsService $service,
    )
    {
        $this->setPermissionsGuard(app(CreateUserParentPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return UserParentType::nonNullType();
    }

    public function args(): array
    {
        $args = array_merge([
            'user_id' => NonNullType::id(),
            'first_name' => NonNullType::string(),
            'last_name' => NonNullType::string(),
            'phone' => NonNullType::string(),
        ], parent::args());

        unset($args['name']);

        return $args;
    }

    protected function getDTO(array $args): Data
    {
        return CreateUserParentDTO::from([
            'userId' => $args['user_id'],
            'email' => $args['email'],
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'],
        ]);
    }
}
