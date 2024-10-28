<?php

// Stores all available permissions for all available guards
use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Permissions\Permissions\PermissionsManageGroupPermission;
use Modules\Permissions\Permissions\Roles\RolesListPermission;
use Modules\Permissions\Permissions\Roles\RolesManageGroupPermission;
use Modules\Permissions\Permissions\Roles\RolesUpdatePermission;
use Modules\Users\Models\Admin;

return [
    Admin::GUARD => [
        PermissionsManageGroupPermission::class => [
            ListPermissionsPermission::class
        ],

        RolesManageGroupPermission::class => [
            RolesListPermission::class,
            RolesUpdatePermission::class,
        ]
    ]
];
