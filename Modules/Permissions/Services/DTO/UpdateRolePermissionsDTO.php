<?php

namespace Modules\Permissions\Services\DTO;

use Spatie\LaravelData\Data;

class UpdateRolePermissionsDTO extends Data
{
    public function __construct(
        public int $roleId,
        public array $permissionsIds,
    )
    {
    }
}
