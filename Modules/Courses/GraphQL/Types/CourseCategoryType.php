<?php

namespace Modules\Courses\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\GraphQL\Types\TranslatableFieldType;
use Modules\Core\Transformers\TranslatableModelAttributesTransformer;
use Modules\Courses\Models\CourseCategory;

class CourseCategoryType extends BaseType
{
    public const NAME = 'CourseCategoryType';

    public const MODEL = CourseCategory::class;

    public function __construct(
        protected TranslatableModelAttributesTransformer $transformer,
    )
    {
    }

    public function fields(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'name' => [
                'type' => TranslatableFieldType::list(),
                'is_relation' => false,
                'resolve' => function ($root, $args) {
                    return $this->transformer->transformAttribute($root, 'name');
                },
            ],
            'slug' => [
                'type' => NonNullType::string(),
            ],
            'meta_title' => [
                'type' => TranslatableFieldType::list(),
                'is_relation' => false,
                'resolve' => function ($root, $args) {
                    return $this->transformer->transformAttribute($root, 'meta_title');
                },
            ],
            'meta_description' => [
                'type' => TranslatableFieldType::list(),
                'is_relation' => false,
                'resolve' => function ($root, $args) {
                    return $this->transformer->transformAttribute($root, 'meta_description');
                },
            ],
            'short_description' => [
                'type' => TranslatableFieldType::list(),
                'is_relation' => false,
                'resolve' => function ($root, $args) {
                    return $this->transformer->transformAttribute($root, 'short_description');
                },
            ],
            'description' => [
                'type' => TranslatableFieldType::list(),
                'is_relation' => false,
                'resolve' => function ($root, $args) {
                    return $this->transformer->transformAttribute($root, 'description');
                },
            ],
            'preview' => [
                'type' => Type::string(),
                'is_relation' => false,
                'resolve' => function (CourseCategory $root, $args) {
                    return $root->getFirstMediaUrl(CourseCategory::MEDIA_COLLECTION_PREVIEW);
                },
            ],
            'banner' => [
                'type' => Type::string(),
                'is_relation' => false,
                'resolve' => function (CourseCategory $root, $args) {
                    return $root->getFirstMediaUrl(CourseCategory::MEDIA_COLLECTION_BANNER);
                },
            ],
            'parent_category' => [
                'type' => CourseCategoryType::type(),
                'alias' => 'parentCategory',
            ],
            'child_categories' => [
                'type' => CourseCategoryType::list(),
                'alias' => 'childCategory',
            ],
            'sort' => [
                'type' => NonNullType::int(),
            ],
            'deleted_at' => [
                'type' => Type::string(),
            ],
            'created_at' => [
                'type' => Type::string(),
            ],
            'updated_at' => [
                'type' => Type::string(),
            ],
        ];
    }
}
