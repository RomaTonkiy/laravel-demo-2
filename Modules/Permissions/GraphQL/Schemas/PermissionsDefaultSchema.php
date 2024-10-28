<?php

namespace Modules\Permissions\GraphQL\Schemas;

use Modules\Permissions\GraphQL\Schemas\Common\PermissionsCommonSchema;

class PermissionsDefaultSchema extends PermissionsCommonSchema
{
    public function toConfig(): array
    {
        return array_merge_recursive(parent::toConfig(), [
            // region Query
            'query' => [
            ],
            // endregion

            // region Mutation
            'mutation' => [

            ],
            // endregion

            // region Types
            'types' => [

            ],
            // endregion
        ]);
    }
}
