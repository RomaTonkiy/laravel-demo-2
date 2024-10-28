<?php

namespace Modules\Users\Permissions\Teachers\ManagePermissions;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class UpdateTeachersPermissionsPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.update');
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.update';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(ManageTeachersPermissionsGroupPermission::class);
    }
}
