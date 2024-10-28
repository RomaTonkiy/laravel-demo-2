<?php

namespace App\Events\Users;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Models\User;

class UserRegisteredEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        User $user
    )
    {
    }
}
