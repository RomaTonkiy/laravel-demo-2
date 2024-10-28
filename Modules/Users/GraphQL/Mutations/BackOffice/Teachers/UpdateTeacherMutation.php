<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Teachers;

use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserUpdateMutation;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\Permissions\Teachers\UpdateTeacherPermission;
use Modules\Users\Services\Teachers\DTO\UpdateTeacherDTO;
use Modules\Users\Services\Teachers\TeachersService;
use Spatie\LaravelData\Data;

class UpdateTeacherMutation extends BaseUserUpdateMutation
{
    public const NAME = 'updateTeacher';

    public function __construct(
        TeachersService $service,
    )
    {
        $this->setPermissionsGuard(app(UpdateTeacherPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return TeacherType::nonNullType();
    }

    public function args(): array
    {
        $args = array_merge([
            'first_name' => NonNullType::string(),
            'last_name' => NonNullType::string(),
            'phone' => Type::string(),
        ], parent::args());

        unset($args['name']);

        return $args;
    }

    protected function getDTO(array $args): Data
    {
        return UpdateTeacherDTO::from([
            'id' => $args['id'],
            'phone' => $args['phone'] ?? null,
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'] ?? null,
        ]);
    }
}
