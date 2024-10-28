<?php

namespace Modules\Users\Services\UserParents\DTO;

use Spatie\LaravelData\Data;

class UpdateUserParentDTO extends Data
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
