<?php

namespace Modules\Permissions\Permissions\Permissions;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class ListPermissionsPermission extends BasePermission
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
        return app(PermissionsManageGroupPermission::class);
    }
}
