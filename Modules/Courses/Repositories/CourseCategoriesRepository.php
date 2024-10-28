<?php

namespace Modules\Courses\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Repositories\AbstractSluggableBaseRepository;
use Modules\Courses\Models\CourseCategory;

/**
 * @extends AbstractSluggableBaseRepository<CourseCategory>
 */
class CourseCategoriesRepository extends AbstractSluggableBaseRepository
{
    protected function modelQuery(): FilterableModelInterface|Builder
    {
        return CourseCategory::query();
    }
}
