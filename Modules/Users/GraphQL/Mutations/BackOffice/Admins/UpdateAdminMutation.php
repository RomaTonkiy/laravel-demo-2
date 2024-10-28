<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Admins;

use GraphQL\Type\Definition\Type;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserUpdateMutation;
use Modules\Users\GraphQL\Types\AdminType;
use Modules\Users\Permissions\Admins\UpdateAdminPermission;
use Modules\Users\Services\Admins\AdminsService;
use Modules\Users\Services\Admins\DTO\UpdateAdminDTO;
use Spatie\LaravelData\Data;

class UpdateAdminMutation extends BaseUserUpdateMutation
{
    public const NAME = 'updateAdmin';

    public function __construct(
        AdminsService $service,
    )
    {
        $this->setPermissionsGuard(app(UpdateAdminPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return AdminType::nonNullType();
    }

    protected function getDTO(array $args): Data
    {
        return UpdateAdminDTO::from([
            'id' => $args['id'],
            'name' => $args['name'],
            'password' => $args['password'] ?? null,
        ]);
    }
}
