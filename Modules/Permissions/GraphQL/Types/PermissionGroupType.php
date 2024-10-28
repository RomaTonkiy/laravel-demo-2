<?php

namespace Modules\Permissions\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;

class PermissionGroupType extends BaseType
{
    public const NAME = 'PermissionGroupType';
    public function fields(): array
    {
        return [
            'key' => [
                'type' => NonNullType::string(),
            ],
            'name' => [
                'type' => NonNullType::string(),
            ],
            'position' => [
                'type' => NonNullType::int(),
            ],
            'permissions' => [
               'type' => PermissionType::list(),
            ],
        ];
    }
}
