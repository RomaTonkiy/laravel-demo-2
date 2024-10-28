<?php

namespace Modules\Users\Services\Organizations\DTO;

use Spatie\LaravelData\Data;

class OrganizationRegisterDTO extends Data
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    )
    {
    }
}
