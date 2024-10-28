<?php

namespace Modules\Users\Permissions\Organizations;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class DeleteOrganizationPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.delete');
    }

    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.delete';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(OrganizationsManageGroupPermission::class);
    }
}
