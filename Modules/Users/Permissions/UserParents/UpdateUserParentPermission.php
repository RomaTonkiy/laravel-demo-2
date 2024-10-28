<?php

namespace Modules\Users\Permissions\UserParents;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class UpdateUserParentPermission extends BasePermission
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
        return app(UserParentsManageGroupPermission::class);
    }
}
