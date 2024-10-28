<?php

namespace Modules\Users\GraphQL\Types;

use Modules\Core\GraphQL\Types\BaseType;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\Models\Admin;
use Modules\Users\Models\Organization;

class OrganizationType extends BaseType
{
    public const NAME = 'OrganizationType';
    public const MODEL = Organization::class;

    public function fields(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
            ],
            'name' => [
                'type' => NonNullType::string(),
            ],
            'email' => [
                'type' => NonNullType::string(),
            ],
            'teachers' => [
                'type' => TeacherType::list(),
                'is_relation' => true,
            ],
        ];
    }
}
