<?php

namespace Modules\Users\GraphQL\Schemas;

use Modules\Users\GraphQL\Mutations\FrontOffice\Organizations\OrganizationRegisterMutation;
use Modules\Users\GraphQL\Mutations\FrontOffice\Organizations\TeachersManagement\CreateOrganizationTeacherMutation;
use Modules\Users\GraphQL\Mutations\FrontOffice\Organizations\TeachersManagement\UpdateOrganizationTeacherMutation;
use Modules\Users\GraphQL\Mutations\FrontOffice\Teachers\TeacherRegisterMutation;
use Modules\Users\GraphQL\Mutations\FrontOffice\Users\UserRegisterMutation;
use Modules\Users\GraphQL\Queries\FrontOffice\Organization\TeachersManagement\ListOrganizationTeachersQuery;
use Modules\Users\GraphQL\Schemas\Common\UsersCommonSchema;

class UsersDefaultSchema extends UsersCommonSchema
{
    public function toConfig(): array
    {
        return array_merge_recursive(parent::toConfig(), [
            // region Query
            'query' => [
                // region Organization
                // region Teachers Management
                ListOrganizationTeachersQuery::class,
                // endregion
                // endregion
            ],
            // endregion

            // region Mutation
            'mutation' => [
                // region Organization
                OrganizationRegisterMutation::class,

                // region Teachers Management
                CreateOrganizationTeacherMutation::class,
                UpdateOrganizationTeacherMutation::class,
                // endregion
                // endregion

                // region Teacher
                TeacherRegisterMutation::class,
                // endregion

                // region User
                UserRegisterMutation::class,
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
