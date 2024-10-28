<?php

namespace Modules\Core\DTO;

use Spatie\LaravelData\Data;

class TranslatableFieldDTO extends Data
{
    public function __construct(
        public string $locale,
        public string $value,
    )
    {
    }
}
