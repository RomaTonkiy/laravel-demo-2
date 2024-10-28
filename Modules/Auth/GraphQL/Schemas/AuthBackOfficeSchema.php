<?php

namespace Modules\Auth\GraphQL\Schemas;

use Modules\Auth\GraphQL\Mutations\BackOffice\Admin\AdminLoginMutation;
use Modules\Auth\GraphQL\Mutations\BackOffice\Admin\AdminLogoutMutation;
use Modules\Auth\GraphQL\Mutations\BackOffice\Admin\AdminRefreshTokenMutation;
use Modules\Auth\GraphQL\Schemas\Common\AuthCommonSchema;

class AuthBackOfficeSchema extends AuthCommonSchema
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
                // region Auth
                AdminLoginMutation::class,
                AdminLogoutMutation::class,
                AdminRefreshTokenMutation::class,
                // endregion
            ],
            // endregion

            // region Types
            'types' => [

            ],
            // endregion
        ]);
    }
}
