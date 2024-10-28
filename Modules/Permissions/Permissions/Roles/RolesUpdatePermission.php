<?php

namespace Modules\Permissions\Permissions\Roles;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class RolesUpdatePermission extends BasePermission
{

    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.update');
    }

    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.update';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(RolesManageGroupPermission::class);
    }
}
