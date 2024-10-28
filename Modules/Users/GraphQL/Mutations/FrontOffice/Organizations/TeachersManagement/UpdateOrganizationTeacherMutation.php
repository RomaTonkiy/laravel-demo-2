<?php

namespace Modules\Users\GraphQL\Mutations\FrontOffice\Organizations\TeachersManagement;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\Models\Organization;
use Modules\Users\Models\Teacher;
use Modules\Users\Permissions\Teachers\UpdateTeacherPermission;
use Modules\Users\Repositories\TeachersRepository;
use Modules\Users\Services\Teachers\DTO\UpdateTeacherDTO;
use Modules\Users\Services\Teachers\TeachersService;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

class UpdateOrganizationTeacherMutation extends BaseMutation
{
    public const NAME = 'updateOrganizationTeacher';

    public function __construct(
        protected TeachersService    $teachersService,
        protected TeachersRepository $teachersRepository,
    )
    {
        $this->setOrganizationGuard();

        $this->setPermissionsGuard(
            app(UpdateTeacherPermission::class)
        );
    }

    public function type(): Type
    {
        return TeacherType::nonNullType();
    }

    public function args(): array
    {
        return [
            'id' => NonNullType::id(),
            'first_name' => NonNullType::string(),
            'last_name' => NonNullType::string(),
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

        $teacher = $this->teachersRepository->findTeacherByOrganization(
            $args['id'],
            $organization->id
        );

        if (!$teacher) {
            throw new \Exception(__('users::validation.teacher_not_found_id_organization'));
        }

        return $this->teachersService->update(
            UpdateTeacherDTO::from([
                'id' => $args['id'],
                'firstName' => $args['first_name'],
                'lastName' => $args['last_name'],
                'phone' => $args['phone'] ?? null,
                'password' => $args['password'],
            ])
        );
    }
}
