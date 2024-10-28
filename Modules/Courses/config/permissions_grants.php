<?php

// Stores all available permissions for all available guards
use Modules\Courses\Permissions\Categories\CreateCourseCategoriesPermission;
use Modules\Courses\Permissions\Categories\DeleteCourseCategoriesPermission;
use Modules\Courses\Permissions\Categories\ListCourseCategoriesPermission;
use Modules\Courses\Permissions\Categories\ManageCourseCategoriesGroupPermission;
use Modules\Courses\Permissions\Categories\UpdateCourseCategoriesPermission;
use Modules\Users\Models\Admin;

return [
    Admin::GUARD => [
        ManageCourseCategoriesGroupPermission::class => [
            ListCourseCategoriesPermission::class,
            CreateCourseCategoriesPermission::class,
            UpdateCourseCategoriesPermission::class,
            DeleteCourseCategoriesPermission::class,
        ],
    ],
];
