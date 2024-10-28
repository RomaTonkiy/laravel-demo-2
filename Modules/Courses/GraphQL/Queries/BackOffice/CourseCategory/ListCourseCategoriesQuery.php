<?php

namespace Modules\Courses\GraphQL\Queries\BackOffice\CourseCategory;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Core\Transformers\TranslatableModelAttributesTransformer;
use Modules\Courses\GraphQL\Types\CourseCategoryType;
use Modules\Courses\Permissions\Categories\ListCourseCategoriesPermission;
use Modules\Courses\Repositories\CourseCategoriesRepository;
use Rebing\GraphQL\Support\SelectFields;

class ListCourseCategoriesQuery extends BaseQuery
{
    public const NAME = 'listCourseCategories';

    public function __construct(
        protected CourseCategoriesRepository $courseCategoriesRepository,
    )
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(
            app(ListCourseCategoriesPermission::class)
        );
    }

    public function type(): GraphQLType
    {
        return CourseCategoryType::paginate();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): LengthAwarePaginator
    {
        return $this->courseCategoriesRepository->getWithPaginator(
            $fields->getRelations(),
            $args,
        );
    }
}
