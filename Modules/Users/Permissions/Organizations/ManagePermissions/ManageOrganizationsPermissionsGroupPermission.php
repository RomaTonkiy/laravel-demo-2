<?php

namespace Modules\Users\Permissions\Organizations\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class ManageOrganizationsPermissionsGroupPermission extends BasePermissionsGroup
{

    public function getKey(): string
    {
        return 'manage_organizations_permissions';
    }

    public function getName(): string
    {
        return __('users::permissions.organizations_manage_group');
    }
}
