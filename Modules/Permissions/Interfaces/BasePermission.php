<?php

namespace Modules\Permissions\Interfaces;

abstract class BasePermission implements PermissionInterface
{
    protected int $id = 0;
    protected string $guardName = '';

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'translate' => $this->getTranslate(),
            'position' => $this->getPosition(),
            'guard_name' => $this->getGuardName(),
        ];
    }

    abstract public function getTranslate(): string;

    public function getPosition(): int
    {
        return 0;
    }

    public function getFullName(): string
    {
        return $this->getGroup()->getName() . ' - ' . $this->getTranslate() . ' (' . $this->getName() . ')';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getGuardName(): string
    {
        return $this->guardName;
    }

    public function setGuardName(string $guardName): void
    {
        $this->guardName = $guardName;
    }
}
