<?php

namespace Modules\Users\Services\Teachers\DTO;

use Spatie\LaravelData\Data;

class UpdateTeacherDTO extends Data
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public ?string $phone,
        public ?string $password,
    )
    {
    }
}
