<?php

namespace Modules\Permissions\Permissions\Roles;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class RolesManageGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_roles';
    }

    public function getName(): string
    {
        return __('permissions::permissions.roles_manage_group');
    }
}
