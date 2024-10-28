<?php

namespace Modules\Permissions\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Permissions\Models\Role;

class RoleType extends BaseType
{
    public const NAME = 'RoleType';
    public const MODEL = Role::class;
    public function fields(): array
    {
        $fields = [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'name' => [
                'type' => NonNullType::string(),
            ],
            'guard_name' => [
                'type' => NonNullType::string(),
            ],
            'permissions' => [
                'type' => PermissionType::nonNullList(),
                'is_relation' => true,
                'description' => 'Current granted permissions for this role',
            ]
        ];

        return array_merge(
            parent::fields(),
            $fields
        );
    }
}
