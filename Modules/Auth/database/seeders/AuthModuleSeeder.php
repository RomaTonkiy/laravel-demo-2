<?php

namespace Modules\Auth\database\seeders;

use Illuminate\Database\Seeder;

class AuthModuleSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PassportClientsSeeder::class,
        ]);
    }
}
