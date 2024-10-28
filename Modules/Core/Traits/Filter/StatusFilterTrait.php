<?php

namespace Modules\Core\Traits\Filter;

trait StatusFilterTrait
{
    public function status(string $status): void
    {
        $this->where(
            $this->getModel()
                ->getTable() . '.status',
            $status
        );
    }
}
