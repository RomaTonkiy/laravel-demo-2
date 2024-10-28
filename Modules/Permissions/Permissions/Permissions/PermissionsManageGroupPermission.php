<?php

namespace Modules\Permissions\Permissions\Permissions;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class PermissionsManageGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_permissions';
    }

    public function getName(): string
    {
        return __('permissions::permissions.permissions_manage_group');
    }
}
