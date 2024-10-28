<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Teachers;

use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserCreateMutation;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\Models\Organization;
use Modules\Users\Permissions\Teachers\CreateTeacherPermission;
use Modules\Users\Services\Teachers\DTO\CreateTeacherDTO;
use Modules\Users\Services\Teachers\TeachersService;
use Spatie\LaravelData\Data;

class CreateTeacherMutation extends BaseUserCreateMutation
{
    public const NAME = 'createTeacher';


    public function __construct(
        TeachersService $service,
    )
    {
        $this->setPermissionsGuard(app(CreateTeacherPermission::class));

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
            'organization_id' => [
                'type' => Type::id(),
                'rules' => ['nullable', Rule::exists(Organization::class, 'id')],
            ],
        ], parent::args());

        unset($args['name']);

        return $args;
    }

    protected function getDTO(array $args): Data
    {
        return CreateTeacherDTO::from([
            'email' => $args['email'],
            'phone' => $args['phone'] ?? null,
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'],
            'organizationId' => $args['organization_id'] ?? null,
        ]);
    }
}
