<?php

namespace App\Listeners\Users;

use App\Events\Users\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserWelcomeNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserRegisteredEvent $event): void
    {
        // TODO: create welcome template
    }
}
