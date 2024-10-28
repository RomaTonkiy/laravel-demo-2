<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Admins;

use GraphQL\Type\Definition\Type;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserCreateMutation;
use Modules\Users\GraphQL\Types\AdminType;
use Modules\Users\Permissions\Admins\CreateAdminPermission;
use Modules\Users\Services\Admins\AdminsService;
use Modules\Users\Services\Admins\DTO\CreateAdminDTO;
use Spatie\LaravelData\Data;

class CreateAdminMutation extends BaseUserCreateMutation
{
    public const NAME = 'createAdmin';

    public function __construct(
        AdminsService $service,
    )
    {
        $this->setPermissionsGuard(app(CreateAdminPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return AdminType::nonNullType();
    }

    protected function getDTO(array $args): Data
    {
        return CreateAdminDTO::from([
            'email' => $args['email'],
            'name' => $args['name'],
            'password' => $args['password'],
        ]);
    }
}
