<?php

namespace Modules\Courses\Permissions\Categories;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class CreateCourseCategoriesPermission extends BasePermission
{

    public function getTranslate(): string
    {
        return trans('permissions::permissions.grants.create');
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.create';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(ManageCourseCategoriesGroupPermission::class);
    }
}
