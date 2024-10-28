<?php

namespace Modules\Users\Services\UserParents\DTO;

use Spatie\LaravelData\Data;

class CreateUserParentDTO extends Data
{
    public function __construct(
        public int    $userId,
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $password,
    )
    {
    }
}
