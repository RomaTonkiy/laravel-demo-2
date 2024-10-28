<?php

namespace Modules\Core\GraphQL\Types;

use Modules\Core\GraphQL\Types\Enums\AvailableLocalesEnum;

class TranslatableFieldType extends BaseType
{
    public const NAME = 'TranslatableFieldType';

    public function fields(): array
    {
        return [
            'locale' => [
                'type' => AvailableLocalesEnum::nonNullType(),
                'description' => 'The locale of the field',
            ],
            'value' => [
                'type' => NonNullType::string(),
                'description' => 'The value of the field',
            ],
        ];
    }
}
