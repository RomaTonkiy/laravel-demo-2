<?php

namespace Modules\Auth\GraphQL\Schemas;

use Modules\Auth\GraphQL\Mutations\FrontOffice\Organizations\OrganizationLoginMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Organizations\OrganizationLogoutMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Organizations\OrganizationRefreshTokenMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Teachers\TeacherLoginMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Teachers\TeacherLogoutMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Teachers\TeacherRefreshTokenMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\UserParents\UserParentLoginMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\UserParents\UserParentLogoutMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\UserParents\UserParentRefreshTokenMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Users\UserLoginMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Users\UserLogoutMutation;
use Modules\Auth\GraphQL\Mutations\FrontOffice\Users\UserRefreshTokenMutation;
use Modules\Auth\GraphQL\Schemas\Common\AuthCommonSchema;

class AuthDefaultSchema extends AuthCommonSchema
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
                // region Organizations
                OrganizationLoginMutation::class,
                OrganizationLogoutMutation::class,
                OrganizationRefreshTokenMutation::class,
                // endregion

                // region Teachers
                TeacherLoginMutation::class,
                TeacherLogoutMutation::class,
                TeacherRefreshTokenMutation::class,
                // endregion

                // region Users
                UserLoginMutation::class,
                UserLogoutMutation::class,
                UserRefreshTokenMutation::class,
                // endregion

                // region User Parents
                UserParentLoginMutation::class,
                UserParentLogoutMutation::class,
                UserParentRefreshTokenMutation::class,
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
