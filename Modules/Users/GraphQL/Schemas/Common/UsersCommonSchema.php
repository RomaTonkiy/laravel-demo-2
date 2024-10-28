<?php

namespace Modules\Users\GraphQL\Schemas\Common;

use Modules\Users\GraphQL\Types\AdminType;
use Modules\Users\GraphQL\Types\OrganizationType;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\GraphQL\Types\UserParentType;
use Modules\Users\GraphQL\Types\UserPermissionsType;
use Modules\Users\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class UsersCommonSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            // region Types
            'types' => [
                AdminType::class,
                OrganizationType::class,
                TeacherType::class,
                UserType::class,
                UserParentType::class,

                UserPermissionsType::class,
            ],
            // endregion
        ];
    }
}
