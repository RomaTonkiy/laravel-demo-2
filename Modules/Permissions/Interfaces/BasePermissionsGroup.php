<?php
namespace Modules\Permissions\Interfaces;

abstract class BasePermissionsGroup implements PermissionsGroupInterface
{
    protected array $permissions = [];

    /**
     * @param BasePermission[] $permissions
     */
    public function __construct(array $permissions = [])
    {
        if(!empty($permissions)) {
            $this->permissions = array_filter(
                $permissions,
                fn(BasePermission $permission) => get_class($permission->getGroup()) === get_class($this)
            );
        }
    }

    public function toArray(): array
    {
        return [
            'key' => $this->getKey(),
            'name' => $this->getName(),
            'position' => $this->getPosition(),
            'permissions' => collect($this->getPermissions())->toArray(),
        ];
    }

    abstract public function getKey(): string;

    public function getPosition(): int
    {
        return 0;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
