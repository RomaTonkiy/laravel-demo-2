<?php

namespace Modules\Core\Transformers;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;

class TranslatableModelAttributesTransformer
{
    /**
     * @throws \Exception
     */
    public function transformAll(Model $model): array
    {
        $attributes = $model->toArray();

        if ($this->checkModelHasTranslations($model)) {
            foreach ($model->getTranslatableAttributes() as $field) {
                $translations = $model->getTranslations($field);
                $resultTranslations = [];

                foreach ($translations as $locale => $translation) {
                    $resultTranslations[] = [
                        'locale' => $locale,
                        'value' => $translation,
                    ];
                }

                $attributes[$field] = $resultTranslations;
            }
        }

        return $attributes;
    }

    /**
     * @throws \Exception
     */
    public function transformAttribute(Model $model, string $attribute): array
    {
        $attributeValue = [];

        if ($this->checkModelHasTranslations($model) && in_array($attribute, $model->getTranslatableAttributes())) {
            $translations = $model->getTranslations($attribute);
            $resultTranslations = [];

            foreach ($translations as $locale => $translation) {
                $resultTranslations[] = [
                    'locale' => $locale,
                    'value' => $translation,
                ];
            }

            $attributeValue = $resultTranslations;
        }

        return $attributeValue;
    }

    /**
     * @throws \Exception
     */
    protected function checkModelHasTranslations(Model $model): bool
    {
        if (
            !in_array(
                 $traitClass = HasTranslations::class,
                class_uses_recursive(get_class($model))
            )
            || !method_exists($model, 'getTranslatableAttributes')
            || !method_exists($model, 'getTranslations')
        ) {
            throw new \Exception("Model does not use {$traitClass} trait");
        }

        return true;
    }
}
