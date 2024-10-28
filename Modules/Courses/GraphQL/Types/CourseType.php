<?php

namespace Modules\Courses\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\GraphQL\Types\TranslatableFieldType;
use Modules\Core\Transformers\TranslatableModelAttributesTransformer;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\CourseCategory;

class CourseType extends BaseType
{
    public const NAME = 'CourseType';

    public const MODEL = Course::class;

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
            'creator_type' => [
                'type' => NonNullType::string(),
            ],
            'creator_id' => [
                'type' => NonNullType::id(),
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
