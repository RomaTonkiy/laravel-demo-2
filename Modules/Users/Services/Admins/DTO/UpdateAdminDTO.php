<?php

namespace Modules\Users\Services\Admins\DTO;

use Spatie\LaravelData\Data;

class UpdateAdminDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $password,
    )
    {
    }
}
