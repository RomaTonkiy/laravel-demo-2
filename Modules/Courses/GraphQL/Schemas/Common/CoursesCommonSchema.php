<?php

namespace Modules\Courses\GraphQL\Schemas\Common;

use Modules\Core\GraphQL\Types\Auth\AuthType;
use Modules\Core\GraphQL\Types\Roles\GrantGroupType;
use Modules\Core\GraphQL\Types\Roles\GrantType;
use Modules\Core\GraphQL\Types\Roles\PermissionType;
use Modules\Core\GraphQL\Types\Roles\RoleType;
use Modules\Courses\GraphQL\Types\CourseCategoryType;
use Modules\Courses\GraphQL\Types\Inputs\CourseCategoryInput;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class CoursesCommonSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            // region Types
            'types' => [
                CourseCategoryType::class,
                CourseCategoryInput::class,
            ],
            // endregion
        ];
    }
}
