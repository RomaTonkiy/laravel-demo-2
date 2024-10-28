<?php

namespace Modules\Users\Filters;

class UserParentFilter extends BaseUserModelFilter
{
    public function allowedOrders(): array
    {
        return array_merge(parent::allowedOrders(), ['first_name', 'last_name', 'phone']);
    }
}
