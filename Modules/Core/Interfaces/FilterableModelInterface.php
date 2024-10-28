<?php

namespace Modules\Core\Interfaces;

interface FilterableModelInterface
{
    public function modelFilter(): string;

    public function scopeFilter($query, array $input = [], $filter = null);

    public function getDefaultPerPage(): int;
}
