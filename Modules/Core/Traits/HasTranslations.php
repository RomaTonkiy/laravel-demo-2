<?php

namespace Modules\Core\Traits;

use Spatie\Translatable\HasTranslations as SpatieHasTranslations;

trait HasTranslations
{
    use SpatieHasTranslations;

    public function toArray()
    {
        $attributes = parent::toArray();

        foreach ($this->getTranslatableAttributes() as $field) {
            $translations = $this->getTranslations($field);
            $resultTranslations = [];

            foreach ($translations as $locale => $translation) {
                $resultTranslations[] = [
                    'locale' => $locale,
                    'value' => $translation,
                ];
            }

            $attributes[$field] = $resultTranslations;
        }
        return $attributes;
    }
}
