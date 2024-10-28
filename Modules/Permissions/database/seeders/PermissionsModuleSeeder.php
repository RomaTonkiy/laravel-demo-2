<?php

namespace Modules\Permissions\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Permissions\database\seeders\Permissions\AvailablePermissionsSeeder;

class PermissionsModuleSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AvailablePermissionsSeeder::class,
        ]);
    }
}
