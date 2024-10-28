<?php
namespace Modules\Permissions\Interfaces;

use Illuminate\Contracts\Support\Arrayable;

interface PermissionsGroupInterface extends Arrayable
{
    public function getKey(): string;

    public function getName(): string;

    /**
     * @return PermissionInterface[]
     */
    public function getPermissions(): array;

    public function getPosition(): int;
}
