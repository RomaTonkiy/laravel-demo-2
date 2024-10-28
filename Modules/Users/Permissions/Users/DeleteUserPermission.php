<?php

namespace Modules\Users\Permissions\Users;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class DeleteUserPermission extends BasePermission
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
        return app(UsersManageGroupPermission::class);
    }
}
