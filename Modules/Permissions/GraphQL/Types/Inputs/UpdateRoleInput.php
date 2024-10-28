<?php

namespace Modules\Permissions\GraphQL\Types\Inputs;

use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Modules\Core\GraphQL\Types\BaseInput;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Permissions\Models\Permission;
use Modules\Permissions\Models\Role;

class UpdateRoleInput extends BaseInput
{
    public const NAME = 'UpdateRoleInput';

    public function fields(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
                'description' => 'Role ID',
                'rules' => [Rule::exists(Role::class, 'id')],
            ],
            'permissions' => [
                'type' => Type::listOf(NonNullType::int()),
                'description' => 'Role permissions, array of permission IDs. Permissions are synced with the given array.',
                'rules' => ['array', Rule::exists(Permission::class, 'id')],
            ],
        ];
    }
}
