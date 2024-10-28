<?php

namespace Modules\Users\Permissions\Admins;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class DeleteAdminPermission extends BasePermission
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
        return app(AdminsManageGroupPermission::class);
    }
}
