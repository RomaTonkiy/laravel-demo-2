<?php

namespace Modules\Courses\Permissions\Categories;

use Modules\Permissions\Interfaces\BasePermissionsGroup;

class ManageCourseCategoriesGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'categories';
    }

    public function getName(): string
    {
        return trans('courses::permissions.categories');
    }
}
