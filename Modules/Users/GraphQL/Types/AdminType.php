<?php

namespace Modules\Users\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\Models\Admin;
use Modules\Users\Models\User;

class AdminType extends BaseType
{
    public const NAME = 'AdminType';
    public const MODEL = Admin::class;

    public function fields(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'name' => [
                'type' => NonNullType::string(),
            ],
            'email' => [
                'type' => NonNullType::string(),
            ]
        ];
    }
}
