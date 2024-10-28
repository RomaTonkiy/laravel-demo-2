<?php

namespace Modules\Users\Services\Organizations\DTO;

use Spatie\LaravelData\Data;

class UpdateOrganizationDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $password,
    )
    {
    }
}
