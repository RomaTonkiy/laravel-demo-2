<?php

namespace Modules\Core\GraphQL\Types\Inputs;

use Modules\Core\GraphQL\Types\BaseInput;
use Modules\Core\GraphQL\Types\Enums\AvailableLocalesEnum;
use Modules\Core\GraphQL\Types\NonNullType;

class TranslatableFieldInput extends BaseInput
{
    public const NAME = 'TranslatableFieldInput';

    public function fields(): array
    {
        return [
            'locale' => [
                'type' => AvailableLocalesEnum::nonNullType(),
            ],
            'value' => [
                'type' => NonNullType::string(),
            ],
        ];
    }
}
