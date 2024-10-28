<?php

namespace Modules\Users\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\Models\User;

class UserType extends BaseType
{
    public const NAME = 'UserType';
    public const MODEL = User::class;

    public function fields(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'first_name' => [
                'type' => NonNullType::string(),
            ],
            'last_name' => [
                'type' => NonNullType::string(),
            ],
            'phone' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => NonNullType::string(),
            ],
            'parents' => [
                'type' => UserParentType::list(),
            ]
        ];
    }
}
