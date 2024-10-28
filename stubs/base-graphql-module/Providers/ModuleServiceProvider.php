<?php

namespace Modules\{Module}\Providers;

use App\Providers\AbstractServiceProvider;

class {Module}ServiceProvider extends AbstractServiceProvider
{
    protected $moduleName = '{Module}';
    protected $moduleNameLower = '{module}';

    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
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
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'config/permissions_grants.php'), 'permissions_grants'
        );
    }

    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
        }
    }

    public function provides()
    {
        return [];
    }
}