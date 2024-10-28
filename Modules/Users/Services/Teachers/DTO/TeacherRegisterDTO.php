<?php

namespace Modules\Users\Services\Teachers\DTO;

use Spatie\LaravelData\Data;

class TeacherRegisterDTO extends Data
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
