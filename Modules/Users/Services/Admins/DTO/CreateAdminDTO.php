<?php

namespace Modules\Users\Services\Admins\DTO;

use Spatie\LaravelData\Data;

class CreateAdminDTO extends Data
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    )
    {
    }
}
