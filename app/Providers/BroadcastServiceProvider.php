<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
