<?php

namespace Modules\Users\GraphQL\Schemas;

use Modules\Users\GraphQL\Mutations\BackOffice\Admins\CreateAdminMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Admins\DeleteAdminMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Admins\UpdateAdminMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Admins\UpdateAdminPermissionsMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Organizations\CreateOrganizationMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Organizations\DeleteOrganizationMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Organizations\UpdateOrganizationMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Organizations\UpdateOrganizationPermissionsMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Teachers\CreateTeacherMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Teachers\DeleteTeacherMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Teachers\UpdateTeacherMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Teachers\UpdateTeacherPermissionsMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\UserParents\CreateUserParentMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\UserParents\DeleteUserParentMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\UserParents\UpdateUserParentMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\UserParents\UpdateUserParentPermissionsMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Users\CreateUserMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Users\DeleteUserMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Users\UpdateUserMutation;
use Modules\Users\GraphQL\Mutations\BackOffice\Users\UpdateUserPermissionsMutation;
use Modules\Users\GraphQL\Queries\BackOffice\Admins\ListAdminPermissionsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Admins\ListAdminsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Organizations\ListOrganizationPermissionsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Organizations\ListOrganizationsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Teachers\ListTeacherPermissionsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Teachers\ListTeachersQuery;
use Modules\Users\GraphQL\Queries\BackOffice\UserParents\ListUserParentPermissionsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\UserParents\ListUserParentsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Users\ListUserPermissionsQuery;
use Modules\Users\GraphQL\Queries\BackOffice\Users\ListUsersQuery;
use Modules\Users\GraphQL\Schemas\Common\UsersCommonSchema;

class UsersBackOfficeSchema extends UsersCommonSchema
{
    public function toConfig(): array
    {
        return array_merge_recursive(parent::toConfig(), [
            // region Query
            'query' => [
                // region Admins
                ListAdminsQuery::class,
                ListAdminPermissionsQuery::class,
                // endregion

                // region Organizations
                ListOrganizationsQuery::class,
                ListOrganizationPermissionsQuery::class,
                // endregion

                // region Teachers
                ListTeachersQuery::class,
                ListTeacherPermissionsQuery::class,
                // endregion

                // region UserParents
                ListUserParentsQuery::class,
                ListUserParentPermissionsQuery::class,
                // endregion

                // region Users
                ListUsersQuery::class,
                ListUserPermissionsQuery::class,
                // endregion
            ],
            // endregion

            // region Mutation
            'mutation' => [
                // region Admins
                CreateAdminMutation::class,
                UpdateAdminMutation::class,
                DeleteAdminMutation::class,
                UpdateAdminPermissionsMutation::class,
                // endregion

                // region Organizations
                CreateOrganizationMutation::class,
                UpdateOrganizationMutation::class,
                DeleteOrganizationMutation::class,
                UpdateOrganizationPermissionsMutation::class,
                // endregion

                // region Teachers
                CreateTeacherMutation::class,
                UpdateTeacherMutation::class,
                DeleteTeacherMutation::class,
                UpdateTeacherPermissionsMutation::class,
                // endregion

                // region UserParents
                CreateUserParentMutation::class,
                UpdateUserParentMutation::class,
                DeleteUserParentMutation::class,
                UpdateUserParentPermissionsMutation::class,
                // endregion

                // region Users
                CreateUserMutation::class,
                UpdateUserMutation::class,
                DeleteUserMutation::class,
                UpdateUserPermissionsMutation::class,
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
