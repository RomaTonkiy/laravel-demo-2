<?php

namespace Modules\Users\Filters;

class AdminFilter extends BaseUserModelFilter
{
    public function allowedOrders(): array
    {
        return array_merge(parent::allowedOrders(), ['name']);
    }
}
