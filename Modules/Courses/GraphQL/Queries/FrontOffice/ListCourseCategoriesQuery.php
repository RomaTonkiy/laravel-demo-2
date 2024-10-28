<?php

namespace Modules\Courses\GraphQL\Queries\FrontOffice;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Courses\GraphQL\Types\CourseCategoryType;
use Modules\Courses\Repositories\CourseCategoriesRepository;
use Rebing\GraphQL\Support\SelectFields;

class ListCourseCategoriesQuery extends BaseQuery
{
    public const NAME = 'listCourseCategories';

    public function __construct(
        protected CourseCategoriesRepository $courseCategoriesRepository,
    )
    {
    }

    public function type(): GraphQLType
    {
        return CourseCategoryType::paginate();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        return $this->courseCategoriesRepository->getWithPaginator(
            $fields->getRelations(),
            $args,
        );
    }
}
