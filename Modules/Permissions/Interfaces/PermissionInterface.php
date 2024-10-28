<?php
namespace Modules\Permissions\Interfaces;

use Illuminate\Contracts\Support\Arrayable;

interface PermissionInterface extends Arrayable
{
    /**
     * Human-readable name for this permission
     * @return string
     */
    public function getTranslate(): string;

    /**
     * Unique key for this permission
     * @return string
     */
    public function getName(): string;

    public function getGroup(): PermissionsGroupInterface;

    public function getPosition(): int;
}
