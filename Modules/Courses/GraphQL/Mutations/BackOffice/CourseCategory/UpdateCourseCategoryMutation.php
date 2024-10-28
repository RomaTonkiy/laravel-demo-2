<?php

namespace Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Courses\GraphQL\Types\CourseCategoryType;
use Modules\Courses\GraphQL\Types\Inputs\CourseCategoryInput;
use Modules\Courses\Models\CourseCategory;
use Modules\Courses\Permissions\Categories\UpdateCourseCategoriesPermission;
use Modules\Courses\Services\CoursesCategoriesService;
use Modules\Courses\Services\DTO\Category\CourseCategoryDTO;
use Rebing\GraphQL\Support\SelectFields;

class UpdateCourseCategoryMutation extends BaseMutation
{
    public const NAME = 'updateCourseCategory';

    public function __construct(
        protected CoursesCategoriesService $coursesService
    )
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(
            app(UpdateCourseCategoriesPermission::class)
        );
    }

    public function type(): Type
    {
        return CourseCategoryType::type();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'course_category' => [
                'type' => CourseCategoryInput::nonNullType(),
            ],
        ];
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): CourseCategory
    {
        return $this->coursesService->update($args['id'], CourseCategoryDTO::createFromInputArgs($args['course_category']));
    }
}
