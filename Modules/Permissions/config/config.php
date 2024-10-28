<?php

use Modules\Users\Models\Admin;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;

return [
    'name' => 'Permissions',

    // Used to specify the list of visible GUARDS for each user guard.
    'visible_guards' => [
        Admin::GUARD => [
            Admin::GUARD,
            Organization::GUARD,
            Teacher::GUARD,
            User::GUARD,
            UserParent::GUARD,
        ],

        Organization::GUARD => [
            Organization::GUARD,
            Teacher::GUARD,
            User::GUARD,
            UserParent::GUARD,
        ],

        Teacher::GUARD => [
            Teacher::GUARD,
            User::GUARD,
            UserParent::GUARD,
        ],

        User::GUARD => [
            User::GUARD,
        ],

        UserParent::GUARD => [
            User::GUARD,
            UserParent::GUARD,
        ],
    ]
];
