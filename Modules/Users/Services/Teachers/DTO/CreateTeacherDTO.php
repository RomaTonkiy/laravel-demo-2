<?php

namespace Modules\Users\Services\Teachers\DTO;

use Spatie\LaravelData\Data;

class CreateTeacherDTO extends Data
{
    public function __construct(
        public string $email,
        public ?string $phone,
        public string $firstName,
        public string $lastName,
        public string $password,
        public ?int $organizationId,
    )
    {
    }
}
