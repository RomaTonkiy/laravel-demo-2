<?php

namespace Modules\Courses\Filters;

use EloquentFilter\ModelFilter;
use Modules\Core\Traits\Filter\IdFilterTrait;
use Modules\Core\Traits\Filter\SlugFilterTrait;
use Modules\Core\Traits\Filter\SortFilterTrait;

class CourseCategoryFilter extends ModelFilter
{
    use IdFilterTrait, SortFilterTrait, SlugFilterTrait;

    public function allowedOrders(): array
    {
        return [
            'id',
            'sort',
        ];
    }
}
