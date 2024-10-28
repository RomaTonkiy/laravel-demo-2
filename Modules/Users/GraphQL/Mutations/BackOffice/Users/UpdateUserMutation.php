<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Users;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserUpdateMutation;
use Modules\Users\GraphQL\Types\UserType;
use Modules\Users\Permissions\Users\UpdateUserPermission;
use Modules\Users\Services\Users\DTO\UpdateUserDTO;
use Modules\Users\Services\Users\UsersService;
use Spatie\LaravelData\Data;

class UpdateUserMutation extends BaseUserUpdateMutation
{
    public const NAME = 'updateUser';

    public function __construct(
        UsersService $service,
    )
    {
        $this->setPermissionsGuard(app(UpdateUserPermission::class));

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
        return UpdateUserDTO::from([
            'id' => $args['id'],
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'] ?? null,
        ]);
    }
}
