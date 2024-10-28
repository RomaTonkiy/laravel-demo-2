<?php

namespace Modules\Users\Permissions\Teachers\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class ManageTeachersPermissionsGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_teachers_permissions';
    }

    public function getName(): string
    {
        return __('users::permissions.teachers_manage_group');
    }
}
