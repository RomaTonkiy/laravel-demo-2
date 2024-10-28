<?php

namespace Modules\Courses\Permissions\Categories;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class ListCourseCategoriesPermission extends BasePermission
{

    public function getTranslate(): string
    {
        return trans('permissions::permissions.grants.list');
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
        return app(ManageCourseCategoriesGroupPermission::class);
    }
}
