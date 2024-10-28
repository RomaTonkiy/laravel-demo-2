<?php

namespace Modules\Users\Filters;

class OrganizationFilter extends BaseUserModelFilter
{
    public function allowedOrders(): array
    {
        return array_merge(parent::allowedOrders(), ['name']);
    }
}
