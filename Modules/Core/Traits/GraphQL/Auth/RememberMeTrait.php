<?php

namespace Modules\Core\Traits\GraphQL\Auth;

use GraphQL\Type\Definition\Type;

trait RememberMeTrait
{
    protected function rememberMeArgs(): array
    {
        return [
            'remember_me' => [
                'type' => Type::boolean(),
                'description' => 'Remember me',
                'rules' => [
                    'boolean',
                ],
                'defaultValue' => false,
            ]
        ];
    }
}
