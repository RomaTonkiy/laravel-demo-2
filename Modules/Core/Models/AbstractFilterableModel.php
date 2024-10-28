<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Traits\Filterable;

abstract class AbstractFilterableModel extends Model implements FilterableModelInterface
{
    use Filterable;

    public function getDefaultPerPage(): int
    {
        return 20;
    }
}
