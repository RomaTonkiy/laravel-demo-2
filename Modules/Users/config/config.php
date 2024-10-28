<?php

use Modules\Users\Models\Admin;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;

return [
    'name' => 'Users',

    'roles' => [
        Admin::ROLE => Admin::GUARD,
        Admin::SUPER_ADMIN_ROLE => Admin::GUARD,
        Organization::ROLE => Organization::GUARD,
        Teacher::ROLE => Teacher::GUARD,
        User::ROLE => User::GUARD,
        UserParent::ROLE => UserParent::GUARD,
    ],
];
