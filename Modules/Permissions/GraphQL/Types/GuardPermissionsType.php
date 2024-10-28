<?php

namespace Modules\Permissions\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;

class GuardPermissionsType extends BaseType
{
    public const NAME = 'GuardPermissionsType';
    public function fields(): array
    {
        return [
            'guard_name' => [
                'type' => NonNullType::string(),
            ],
            'groups' => [
                'type' => PermissionGroupType::list(),
            ]
        ];
    }
}
