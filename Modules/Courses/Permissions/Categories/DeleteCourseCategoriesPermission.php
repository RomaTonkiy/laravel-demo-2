<?php

namespace Modules\Courses\Permissions\Categories;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class DeleteCourseCategoriesPermission extends BasePermission
{

    public function getTranslate(): string
    {
        return trans('permissions::permissions.grants.delete');
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.delete';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(ManageCourseCategoriesGroupPermission::class);
    }
}
