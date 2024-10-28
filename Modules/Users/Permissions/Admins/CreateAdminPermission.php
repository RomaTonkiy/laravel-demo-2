<?php

namespace Modules\Users\Permissions\Admins;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class CreateAdminPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.create');
    }

    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.create';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(AdminsManageGroupPermission::class);
    }
}
