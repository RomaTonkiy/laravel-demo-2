<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Users;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserCreateMutation;
use Modules\Users\GraphQL\Types\UserType;
use Modules\Users\Permissions\Users\CreateUserPermission;
use Modules\Users\Services\Users\DTO\CreateUserDTO;
use Modules\Users\Services\Users\UsersService;
use Spatie\LaravelData\Data;

class CreateUserMutation extends BaseUserCreateMutation
{
    public const NAME = 'createUser';

    public function __construct(
        UsersService $service,
    )
    {
        $this->setPermissionsGuard(app(CreateUserPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return UserType::nonNullType();
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
        return CreateUserDTO::from([
            'email' => $args['email'],
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'],
        ]);
    }
}
