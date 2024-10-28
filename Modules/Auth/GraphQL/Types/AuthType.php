<?php

namespace Modules\Auth\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;

class AuthType extends BaseType
{
    public const NAME = 'AuthType';
    public const DESCRIPTION = 'Containing info about authentication';

    public function fields(): array
    {
        return [
            'tokenType' => [
                'type' => NonNullType::string(),
                'description' => 'The type of the token',
            ],
            'expiresIn' => [
                'type' => NonNullType::int(),
                'description' => 'The time in seconds the token expires in',
            ],
            'accessToken' => [
                'type' => NonNullType::string(),
                'description' => 'The access token',
            ],
            'refreshToken' => [
                'type' => NonNullType::string(),
                'description' => 'The refresh token',
            ],
        ];
    }
}
