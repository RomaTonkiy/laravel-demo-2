<?php

namespace Modules\Users\Permissions\UserParents;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class UserParentsManageGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'manage_user_parents';
    }

    public function getName(): string
    {
        return __('users::permissions.user_parents_manage_group');
    }
}
