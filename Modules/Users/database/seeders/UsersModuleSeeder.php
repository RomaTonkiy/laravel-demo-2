<?php

namespace Modules\Users\database\seeders;

use Illuminate\Database\Seeder;

class UsersModuleSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
        ]);
    }
}
