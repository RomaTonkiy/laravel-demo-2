<?php

namespace Modules\Permissions\database\seeders\Permissions;

use Illuminate\Database\Seeder;

class AvailablePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $availablePermissions = config('permissions_grants');
    }
}
