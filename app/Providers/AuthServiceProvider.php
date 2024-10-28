<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Modules\Users\Models\Admin;
use Modules\Users\Models\BaseAuthenticatableUser;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function (BaseAuthenticatableUser $user, $ability) {
            return $user->hasRole(Admin::SUPER_ADMIN_ROLE, Admin::GUARD) ? true : null;
        });
    }
}
