<?php

namespace Modules\Core\Transformers;

use Spatie\LaravelData\DataCollection;

class TranslatableFieldInputTransformer
{

    public static function transform(
        null|DataCollection $collection
    ): array
    {
        $result = [];

        foreach ($collection ?? [] as $item) {
            $result[$item->locale] = $item->value;
        }

        return $result;
    }
}
