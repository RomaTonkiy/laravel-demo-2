<?php

namespace Modules\Users\GraphQL\Mutations\FrontOffice\Organizations\TeachersManagement;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\Models\Organization;
use Modules\Users\Permissions\Teachers\CreateTeacherPermission;
use Modules\Users\Services\Teachers\DTO\CreateTeacherDTO;
use Modules\Users\Services\Teachers\TeachersService;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

class CreateOrganizationTeacherMutation extends BaseMutation
{
    public const NAME = 'createOrganizationTeacher';

    public function __construct(
        protected TeachersService $teachersService
    )
    {
        $this->setOrganizationGuard();

        $this->setPermissionsGuard(
            app(CreateTeacherPermission::class)
        );
    }

    public function type(): Type
    {
        return TeacherType::nonNullType();
    }

    public function args(): array
    {
        return [
            'first_name' => NonNullType::string(),
            'last_name' => NonNullType::string(),
            'email' => [
                'type' => NonNullType::string(),
                'rules' => ['email'],
                'description' => 'Email address. Validated with email rule. Should be unique',
            ],
            'phone' => Type::string(),
            'password' => [
                'type' => NonNullType::string(),
                'rules' => ['min:8'],
                'description' => 'Password. Validated with min:8 rule',
            ],
        ];
    }

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        /**
         * @var Organization $organization
         */
        $organization = $this->getAuthUser();

        return $this->teachersService->create(
            CreateTeacherDTO::from([
                'email' => $args['email'],
                'phone' => $args['phone'] ?? null,
                'firstName' => $args['first_name'],
                'lastName' => $args['last_name'],
                'password' => $args['password'],
                'organizationId' => $organization->id,
            ])
        );
    }
}
