<?php

namespace Modules\Courses\GraphQL\Mutations\BackOffice\Course;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateCourseMutation extends BaseMutation
{
    public const NAME = 'createCourse';

    public function type(): Type
    {
        // TODO: Implement type() method.
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        // TODO: Implement doResolve() method.
    }
}
