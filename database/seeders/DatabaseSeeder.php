<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Nwidart\Modules\Facades\Module;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * @var \Nwidart\Modules\Module[] $modules
         */
        $modules = Module::allEnabled();
        $modulesSeeds = [];

        foreach ($modules as $module) {
            $moduleSeeder = config('modules.namespace') . '\\'. $module->getName() . '\\database\\seeders\\' . $module->getName() . 'ModuleSeeder';

            if ($moduleSeeder && class_exists($moduleSeeder)) {
                $moduleSeeder = app($moduleSeeder);

                if (
                    $moduleSeeder instanceof Seeder
                    && method_exists($moduleSeeder, 'run')
                ) {
                    $modulesSeeds[] = get_class($moduleSeeder);
                }
            }
        }

        $this->call($modulesSeeds);
    }
}
