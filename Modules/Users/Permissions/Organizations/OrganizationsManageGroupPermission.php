<?php

namespace Modules\Users\Permissions\Organizations;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class OrganizationsManageGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'manage_organizations';
    }

    public function getName(): string
    {
        return __('users::permissions.organizations_manage_group');
    }
}
