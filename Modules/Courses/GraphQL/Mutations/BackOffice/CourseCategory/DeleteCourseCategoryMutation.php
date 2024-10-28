<?php

namespace Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Courses\Permissions\Categories\DeleteCourseCategoriesPermission;
use Modules\Courses\Services\CoursesCategoriesService;
use Rebing\GraphQL\Support\SelectFields;

class DeleteCourseCategoryMutation extends BaseMutation
{
    public const NAME = 'deleteCourseCategory';

    public function __construct(
        protected CoursesCategoriesService $coursesService
    )
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(
            app(DeleteCourseCategoriesPermission::class)
        );
    }

    public function type(): Type
    {
        return NonNullType::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ]
        ];
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): bool
    {
        return $this->coursesService->delete($args['id']);
    }
}
