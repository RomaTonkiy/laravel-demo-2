<?php

namespace Modules\Users\Permissions\Users;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class UpdateUserPermission extends BasePermission
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
        return app(UsersManageGroupPermission::class);
    }
}
