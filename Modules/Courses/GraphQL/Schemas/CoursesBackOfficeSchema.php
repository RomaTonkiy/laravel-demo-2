<?php

namespace Modules\Courses\GraphQL\Schemas;

use Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\CreateCourseCategoryMutation;
use Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\DeleteCourseCategoryMutation;
use Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\Files\UploadCourseCategoryBannerMutation;
use Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\Files\UploadCourseCategoryPreviewMutation;
use Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\UpdateCourseCategoryMutation;
use Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\UpdateSortingCourseCategoryMutation;
use Modules\Courses\GraphQL\Queries\BackOffice\CourseCategory\GetCourseCategoryQuery;
use Modules\Courses\GraphQL\Queries\BackOffice\CourseCategory\ListCourseCategoriesQuery;
use Modules\Courses\GraphQL\Schemas\Common\CoursesCommonSchema;

class CoursesBackOfficeSchema extends CoursesCommonSchema
{
    public function toConfig(): array
    {
        return array_merge_recursive(parent::toConfig(), [
            // region Query
            'query' => [
                ListCourseCategoriesQuery::class,
            ],
            // endregion

            // region Mutation
            'mutation' => [
                CreateCourseCategoryMutation::class,
                UpdateCourseCategoryMutation::class,
                UpdateSortingCourseCategoryMutation::class,
                DeleteCourseCategoryMutation::class,
                UploadCourseCategoryPreviewMutation::class,
                UploadCourseCategoryBannerMutation::class,
            ],
            // endregion

            // region Types
            'types' => [

            ],
            // endregion
        ]);
    }
}
