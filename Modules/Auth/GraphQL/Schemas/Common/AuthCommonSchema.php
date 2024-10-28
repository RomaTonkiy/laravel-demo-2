<?php

namespace Modules\Auth\GraphQL\Schemas\Common;

use Modules\Auth\GraphQL\Types\AuthType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class AuthCommonSchema implements ConfigConvertible
{

    public function toConfig(): array
    {
        return [
            'types' => [
                AuthType::class,
            ]
        ];
    }
}
