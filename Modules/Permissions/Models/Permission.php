<?php

namespace Modules\Permissions\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Permissions\Services\PermissionService;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public const TABLE = 'permissions';

    public $table = self::TABLE;

    protected $fillable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'translate',
    ];

    protected function translate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->base_permission->getTranslate(),
        );
    }

    protected function position(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->base_permission->getPosition(),
        );
    }

    protected function basePermission(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => app(PermissionService::class)->getBasePermissionByModel($this),
        );
    }
}
