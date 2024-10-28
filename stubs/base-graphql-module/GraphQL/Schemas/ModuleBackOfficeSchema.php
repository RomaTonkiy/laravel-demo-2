<?php

namespace Modules\{Module}\GraphQL\Schemas;

use Modules\{Module}\GraphQL\Schemas\Common\{Module}CommonSchema;

class {Module}BackOfficeSchema extends {Module}CommonSchema
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
