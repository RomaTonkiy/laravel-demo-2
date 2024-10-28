<?php

namespace Modules\Permissions\GraphQL\Schemas;

use Modules\Permissions\GraphQL\Mutations\BackOffice\Roles\UpdateRolesPermissionsMutation;
use Modules\Permissions\GraphQL\Queries\BackOffice\Permissions\PermissionsListQuery;
use Modules\Permissions\GraphQL\Queries\BackOffice\Roles\RolesListQuery;
use Modules\Permissions\GraphQL\Schemas\Common\PermissionsCommonSchema;

class PermissionsBackOfficeSchema extends PermissionsCommonSchema
{
    public function toConfig(): array
    {
        return array_merge_recursive(parent::toConfig(), [
            // region Query
            'query' => [
                RolesListQuery::class,
                PermissionsListQuery::class,
            ],
            // endregion

            // region Mutation
            'mutation' => [
                UpdateRolesPermissionsMutation::class,
            ],
            // endregion

            // region Types
            'types' => [

            ],
            // endregion
        ]);
    }
}
