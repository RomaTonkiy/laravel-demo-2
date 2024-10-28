<?php

namespace Modules\Users\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\Models\Admin;

class SuperAdminSeeder extends Seeder
{
    public function __construct(
        protected PermissionService $permissionService
    )
    {
    }

    public function run(): void
    {
        $defaultSuperAdmin = Admin::firstOrCreate([
            'email' => 'superadmin@mail.com',
        ], [
            'name' => 'Super Admin',
            'password' => 'password1',
        ]);

        $this->permissionService->setSuperAdminRole($defaultSuperAdmin);
    }
}
