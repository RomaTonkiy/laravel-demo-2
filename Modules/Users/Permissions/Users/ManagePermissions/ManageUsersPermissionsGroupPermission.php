<?php

namespace Modules\Users\Permissions\Users\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class ManageUsersPermissionsGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_users_permissions';
    }

    public function getName(): string
    {
        return __('users::permissions.users_permissions_manage_group');
    }
}
