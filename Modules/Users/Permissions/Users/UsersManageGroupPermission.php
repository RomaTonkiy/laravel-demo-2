<?php

namespace Modules\Users\Permissions\Users;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class UsersManageGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'manage_users';
    }

    public function getName(): string
    {
        return __('users::permissions.users_manage_group');
    }
}
