<?php

namespace Modules\Users\Permissions\Users;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class ListUsersPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.list');
    }

    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.list';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(UsersManageGroupPermission::class);
    }
}
