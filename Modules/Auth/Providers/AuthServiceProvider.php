<?php

namespace Modules\Auth\Providers;

use App\Providers\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $moduleName = 'Auth';
    protected $moduleNameLower = 'auth';

    public function boot()
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
    }

    public function register()
    {
    }

    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower
        );
    }

    public function provides()
    {
        return [];
    }
}
