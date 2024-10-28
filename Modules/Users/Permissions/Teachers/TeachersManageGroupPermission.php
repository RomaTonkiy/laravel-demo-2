<?php

namespace Modules\Users\Permissions\Teachers;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class TeachersManageGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'manage_teachers';
    }

    public function getName(): string
    {
        return __('users::permissions.teachers_manage_group');
    }
}
