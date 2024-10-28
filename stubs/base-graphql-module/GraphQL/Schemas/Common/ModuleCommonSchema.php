<?php

namespace Modules\{Module}\GraphQL\Schemas\Common;

use Modules\Core\GraphQL\Types\Auth\AuthType;
use Modules\Core\GraphQL\Types\Roles\GrantGroupType;
use Modules\Core\GraphQL\Types\Roles\GrantType;
use Modules\Core\GraphQL\Types\Roles\PermissionType;
use Modules\Core\GraphQL\Types\Roles\RoleType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class {Module}CommonSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            // region Types
            'types' => [
            ],
            // endregion
        ];
    }
}
