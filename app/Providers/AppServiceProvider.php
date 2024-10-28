<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends AbstractServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
        Passport::ignoreMigrations();
        Telescope::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
