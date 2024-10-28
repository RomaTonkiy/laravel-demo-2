<?php

namespace Modules\Core\Traits\GraphQL;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionInterface;
use Throwable;

trait BaseAttributesTrait
{
    public function attributes(): array
    {
        $description = static::DESCRIPTION;

        try {
            $permission = $this->getPermissionsGuard();
        } catch (Throwable) {
            $permission = null;
        }

        if (!empty($permission)) {
            $temp = [];
            foreach ($permission ?? [] as $sPermission) {
                $temp[] = $this->getPermission($sPermission);
            }

            $permission = implode(', ', $temp);

            $description .= PHP_EOL . 'Required permission: ' . $permission;
        }

        return [
            'name' => static::NAME,
            'description' => $description,
        ];
    }

    private function getPermission(PermissionInterface|string $permission)
    {
        if ($permission instanceof BasePermission) {
            $permission = $permission->getFullName();
        }

        return $permission;
    }
}
