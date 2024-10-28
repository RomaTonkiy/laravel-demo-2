<?php

namespace Modules\Users\Services\Users\DTO;

use Spatie\LaravelData\Data;

class UpdateUserDTO extends Data
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public ?string $password,
    )
    {
    }
}
