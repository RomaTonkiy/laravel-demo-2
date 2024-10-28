<?php

namespace Modules\Courses\GraphQL\Types\Inputs;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\BaseInput;
use Modules\Core\GraphQL\Types\Inputs\TranslatableFieldInput;

class CourseCategoryInput extends BaseInput
{
    public const NAME = 'CourseCategoryInput';

    public function fields(): array
    {
        return [
            'name' => [
                'type' => TranslatableFieldInput::nonNullList(),
            ],
            'slug' => [
                'type' => Type::string(),
            ],
            'meta_title' => [
                'type' => TranslatableFieldInput::list(),
            ],
            'meta_description' => [
                'type' => TranslatableFieldInput::list(),
            ],
            'short_description' => [
                'type' => TranslatableFieldInput::list(),
            ],
            'description' => [
                'type' => TranslatableFieldInput::list(),
            ],
            'parent_id' => [
                'type' => Type::int(),
            ]
        ];
    }
}
