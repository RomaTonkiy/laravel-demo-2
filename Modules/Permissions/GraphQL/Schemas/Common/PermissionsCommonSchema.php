<?php

namespace Modules\Permissions\GraphQL\Schemas\Common;

use Modules\Permissions\GraphQL\Queries\Common\UserAvailablePermissionsQuery;
use Modules\Permissions\GraphQL\Types\GuardPermissionsType;
use Modules\Permissions\GraphQL\Types\Inputs\UpdateRoleInput;
use Modules\Permissions\GraphQL\Types\PermissionGroupType;
use Modules\Permissions\GraphQL\Types\PermissionType;
use Modules\Permissions\GraphQL\Types\RoleType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class PermissionsCommonSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            // region Types
            'types' => [
                RoleType::class,
                GuardPermissionsType::class,
                PermissionGroupType::class,
                PermissionType::class,

                UpdateRoleInput::class,
            ],
            // endregion

            // region Query
            'query' => [
                UserAvailablePermissionsQuery::class,
            ],
            // endregion
        ];
    }
}
