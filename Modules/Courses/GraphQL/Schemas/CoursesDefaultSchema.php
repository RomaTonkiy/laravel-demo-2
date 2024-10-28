<?php

namespace Modules\Courses\GraphQL\Schemas;

use Modules\Courses\GraphQL\Queries\FrontOffice\ListCourseCategoriesQuery;
use Modules\Courses\GraphQL\Schemas\Common\CoursesCommonSchema;

class CoursesDefaultSchema extends CoursesCommonSchema
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

            ],
            // endregion

            // region Types
            'types' => [

            ],
            // endregion
        ]);
    }
}
