<?php

namespace Modules\Users\Filters;

use EloquentFilter\ModelFilter;
use Modules\Core\Traits\Filter\IdFilterTrait;
use Modules\Core\Traits\Filter\SortFilterTrait;

abstract class BaseUserModelFilter extends ModelFilter
{
    use IdFilterTrait, SortFilterTrait;

    public function allowedOrders(): array
    {
        return [
            'id',
            'email',
        ];
    }
}
