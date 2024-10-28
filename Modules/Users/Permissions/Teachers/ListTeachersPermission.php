<?php

namespace Modules\Users\Permissions\Teachers;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class ListTeachersPermission extends BasePermission
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
        return app(TeachersManageGroupPermission::class);
    }
}
