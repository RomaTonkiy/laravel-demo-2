<?php

namespace Modules\Users\Services\UserParents\DTO;

use Modules\Users\Models\User;
use Spatie\LaravelData\Data;

class RegisterUserParentDTO extends Data
{
    public function __construct(
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $password,
        public ?string $phone,
        public User $user,
    )
    {
    }
}
