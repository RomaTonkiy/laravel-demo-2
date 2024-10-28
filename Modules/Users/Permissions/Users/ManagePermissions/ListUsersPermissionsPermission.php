<?php

namespace Modules\Users\Permissions\Users\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class ListUsersPermissionsPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.list');
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.list';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(ManageUsersPermissionsGroupPermission::class);
    }
}
