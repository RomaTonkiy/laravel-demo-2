<?php

namespace Modules\Courses\Permissions\Categories;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class UpdateCourseCategoriesPermission extends BasePermission
{

    public function getTranslate(): string
    {
        return trans('permissions::permissions.grants.update');
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
        return app(ManageCourseCategoriesGroupPermission::class);
    }
}
