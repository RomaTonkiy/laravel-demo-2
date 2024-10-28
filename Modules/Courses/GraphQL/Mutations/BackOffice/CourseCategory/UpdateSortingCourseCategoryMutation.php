<?php

namespace Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Courses\Permissions\Categories\UpdateCourseCategoriesPermission;
use Modules\Courses\Services\CoursesCategoriesService;
use Rebing\GraphQL\Support\SelectFields;

class UpdateSortingCourseCategoryMutation extends BaseMutation
{
    public const NAME = 'updateSortingCourseCategory';

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
        return NonNullType::int();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'sort' => [
                'type' => NonNullType::int(),
            ]
        ];
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): int
    {
        return $this->coursesService->updateSorting($args['id'], $args['sort']);
    }
}
