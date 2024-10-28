<?php

namespace Modules\Users\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Permissions\GraphQL\Types\PermissionType;

class UserPermissionsType extends BaseType
{
    public const NAME = 'UserPermissions';

    public function fields(): array
    {
        return [
            'direct' => [
                'type' => PermissionType::list(),
                'description' => 'Direct permissions that granted to user',
            ],
            'via_roles' => [
                'type' => PermissionType::list(),
                'description' => 'Permissions that granted to user via roles',
            ]
        ];
    }
}
