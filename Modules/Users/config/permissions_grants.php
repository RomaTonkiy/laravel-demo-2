<?php

use Modules\Users\Models\Admin;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;
use Modules\Users\Permissions\Admins\AdminsManageGroupPermission;
use Modules\Users\Permissions\Admins\CreateAdminPermission;
use Modules\Users\Permissions\Admins\DeleteAdminPermission;
use Modules\Users\Permissions\Admins\ListAdminsPermission;
use Modules\Users\Permissions\Admins\ManagePermissions\ListAdminsPermissionsPermission;
use Modules\Users\Permissions\Admins\ManagePermissions\ManageAdminsPermissionsGroupPermission;
use Modules\Users\Permissions\Admins\ManagePermissions\UpdateAdminsPermissionsPermission;
use Modules\Users\Permissions\Admins\UpdateAdminPermission;
use Modules\Users\Permissions\Organizations\CreateOrganizationPermission;
use Modules\Users\Permissions\Organizations\DeleteOrganizationPermission;
use Modules\Users\Permissions\Organizations\ListOrganizationsPermission;
use Modules\Users\Permissions\Organizations\ManagePermissions\ListOrganizationsPermissionsPermission;
use Modules\Users\Permissions\Organizations\ManagePermissions\ManageOrganizationsPermissionsGroupPermission;
use Modules\Users\Permissions\Organizations\ManagePermissions\UpdateOrganizationsPermissionsPermission;
use Modules\Users\Permissions\Organizations\OrganizationsManageGroupPermission;
use Modules\Users\Permissions\Organizations\UpdateOrganizationPermission;
use Modules\Users\Permissions\Teachers\CreateTeacherPermission;
use Modules\Users\Permissions\Teachers\DeleteTeacherPermission;
use Modules\Users\Permissions\Teachers\ListTeachersPermission;
use Modules\Users\Permissions\Teachers\ManagePermissions\ListTeachersPermissionsPermission;
use Modules\Users\Permissions\Teachers\ManagePermissions\ManageTeachersPermissionsGroupPermission;
use Modules\Users\Permissions\Teachers\ManagePermissions\UpdateTeachersPermissionsPermission;
use Modules\Users\Permissions\Teachers\TeachersManageGroupPermission;
use Modules\Users\Permissions\Teachers\UpdateTeacherPermission;
use Modules\Users\Permissions\UserParents\CreateUserParentPermission;
use Modules\Users\Permissions\UserParents\DeleteUserParentPermission;
use Modules\Users\Permissions\UserParents\ListUserParentsPermission;
use Modules\Users\Permissions\UserParents\ManagePermissions\ListUserParentsPermissionsPermission;
use Modules\Users\Permissions\UserParents\ManagePermissions\ManageUserParentsPermissionsGroupPermission;
use Modules\Users\Permissions\UserParents\ManagePermissions\UpdateUserParentsPermissionsPermission;
use Modules\Users\Permissions\UserParents\UpdateUserParentPermission;
use Modules\Users\Permissions\UserParents\UserParentsManageGroupPermission;
use Modules\Users\Permissions\Users\CreateUserPermission;
use Modules\Users\Permissions\Users\DeleteUserPermission;
use Modules\Users\Permissions\Users\ListUsersPermission;
use Modules\Users\Permissions\Users\ManagePermissions\ListUsersPermissionsPermission;
use Modules\Users\Permissions\Users\ManagePermissions\ManageUsersPermissionsGroupPermission;
use Modules\Users\Permissions\Users\ManagePermissions\UpdateUsersPermissionsPermission;
use Modules\Users\Permissions\Users\UpdateUserPermission;
use Modules\Users\Permissions\Users\UsersManageGroupPermission;

return [
    Admin::GUARD => [
        // region Admins
        AdminsManageGroupPermission::class => [
            ListAdminsPermission::class,
            CreateAdminPermission::class,
            UpdateAdminPermission::class,
            DeleteAdminPermission::class
        ],

        ManageAdminsPermissionsGroupPermission::class => [
            ListAdminsPermissionsPermission::class,
            UpdateAdminsPermissionsPermission::class,
        ],
        // endregion

        // region Organizations
        OrganizationsManageGroupPermission::class => [
            ListOrganizationsPermission::class,
            CreateOrganizationPermission::class,
            UpdateOrganizationPermission::class,
            DeleteOrganizationPermission::class
        ],

        ManageOrganizationsPermissionsGroupPermission::class => [
            ListOrganizationsPermissionsPermission::class,
            UpdateOrganizationsPermissionsPermission::class,
        ],
        // endregion

        // region Teachers
        TeachersManageGroupPermission::class => [
            ListTeachersPermission::class,
            CreateTeacherPermission::class,
            UpdateTeacherPermission::class,
            DeleteTeacherPermission::class
        ],

        ManageTeachersPermissionsGroupPermission::class => [
            ListTeachersPermissionsPermission::class,
            UpdateTeachersPermissionsPermission::class,
        ],
        // endregion

        // region Users
        UsersManageGroupPermission::class => [
            ListUsersPermission::class,
            CreateUserPermission::class,
            UpdateUserPermission::class,
            DeleteUserPermission::class
        ],

        ManageUsersPermissionsGroupPermission::class => [
            ListUsersPermissionsPermission::class,
            UpdateUsersPermissionsPermission::class,
        ],
        // endregion

        // region UserParents
        UserParentsManageGroupPermission::class => [
            ListUserParentsPermission::class,
            CreateUserParentPermission::class,
            UpdateUserParentPermission::class,
            DeleteUserParentPermission::class
        ],

        ManageUserParentsPermissionsGroupPermission::class => [
            ListUserParentsPermissionsPermission::class,
            UpdateUserParentsPermissionsPermission::class,
        ],
        // endregion
    ],

    Organization::GUARD => [
        // region Teachers
        TeachersManageGroupPermission::class => [
            ListTeachersPermission::class,
            CreateTeacherPermission::class,
            UpdateTeacherPermission::class,
            DeleteTeacherPermission::class
        ],

        ManageTeachersPermissionsGroupPermission::class => [
            ListTeachersPermissionsPermission::class,
            UpdateTeachersPermissionsPermission::class,
        ],
        // endregion
    ],

    Teacher::GUARD => [

    ],

    User::GUARD => [
    ],

    UserParent::GUARD => [

    ],
];
