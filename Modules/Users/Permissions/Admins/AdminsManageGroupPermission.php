<?php

namespace Modules\Users\Permissions\Admins;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class AdminsManageGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'manage_admins';
    }

    public function getName(): string
    {
        return __('users::permissions.admins_manage_group');
    }
}
