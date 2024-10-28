<?php

namespace Modules\Users\Permissions\UserParents\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class ManageUserParentsPermissionsGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_user_parents_permissions';
    }

    public function getName(): string
    {
        return __('users::permissions.user_parents_manage_group');
    }
}
