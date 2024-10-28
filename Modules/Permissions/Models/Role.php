<?php

namespace Modules\Permissions\Models;

use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Traits\Filterable;
use Modules\Permissions\Filters\Permissions\RoleFilter;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole implements FilterableModelInterface
{
    use Filterable;

    public const ALLOWED_SORTING_FIELDS = [
        'id',
        'created_at',
        'updated_at',
        'title',
    ];

    public const TABLE = 'roles';

    public $table = self::TABLE;

    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function modelFilter(): string
    {
        return RoleFilter::class;
    }

    public function getDefaultPerPage(): int
    {
        return 20;
    }
}
