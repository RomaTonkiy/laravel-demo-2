<?php

namespace Modules\Permissions\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Permissions\Models\Permission;

class PermissionType extends BaseType
{
    public const NAME = 'PermissionType';

    public const MODEL = Permission::class;

    public function fields(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'name' => [
                'type' => NonNullType::string(),
                'description' => 'Unique key for this permission',
            ],
            // dont exist in DB
            'translate' => [
                'type' => NonNullType::string(),
                'description' => 'Human-readable name for this permission',
            ],
            // dont exist in DB
            'position' => [
                'type' => NonNullType::int(),
                'description' => 'Position of this permission in the group',
            ],
            'guard_name' => [
                'type' => NonNullType::string(),
                'description' => 'Guard name for this permission',
            ],
        ];
    }
}
