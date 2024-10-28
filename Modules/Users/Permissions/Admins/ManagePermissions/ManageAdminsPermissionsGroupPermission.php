<?php

namespace Modules\Users\Permissions\Admins\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class ManageAdminsPermissionsGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_admins_permissions';
    }

    public function getName(): string
    {
        return __('users::permissions.admins_permissions_manage_group');
    }
}
