<?php

namespace Modules\Permissions\Filters\Permissions;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Traits\Filter\IdFilterTrait;
use Modules\Core\Traits\Filter\SortFilterTrait;
use Modules\Permissions\Models\Role;

class RoleFilter extends ModelFilter
{
    use SortFilterTrait;
    use IdFilterTrait;

    public function title(string $title): void
    {
        $title = strtolower($title);

        $this->whereHas(
            'translation',
            function (Builder $builder) use ($title) {
                $builder->where(
                    function (Builder $builder) use ($title) {
                        $builder->orWhereRaw('LOWER(`title`) LIKE ?', ["%$title%"]);
                    }
                );
            }
        );
    }

    public function allowedOrders(): array
    {
        return Role::ALLOWED_SORTING_FIELDS;
    }
}
