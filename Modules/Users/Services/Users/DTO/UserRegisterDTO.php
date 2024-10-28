<?php

namespace Modules\Users\Services\Users\DTO;

use Spatie\LaravelData\Data;

class UserRegisterDTO extends Data
{
    public function __construct(
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $password,
        public ?string $phone,
    )
    {
    }
}
