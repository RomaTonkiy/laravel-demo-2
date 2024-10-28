<?php

namespace Modules\Permissions\Services\DTO;

use Illuminate\Support\Collection;
use Modules\Permissions\Interfaces\BasePermissionsGroup;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class GroupedGuardDTO extends Data
{
    /**
     * @param string $guardName
     * @var Collection<BasePermissionsGroup> $groups
     */
    public function __construct(
        public string     $guardName,
        public Collection $groups,
    )
    {
    }
}
