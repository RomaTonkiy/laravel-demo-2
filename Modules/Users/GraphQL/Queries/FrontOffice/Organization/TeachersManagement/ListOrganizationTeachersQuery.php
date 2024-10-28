<?php

namespace Modules\Users\GraphQL\Queries\FrontOffice\Organization\TeachersManagement;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\Models\Organization;
use Modules\Users\Permissions\Teachers\ListTeachersPermission;
use Modules\Users\Repositories\TeachersRepository;
use Rebing\GraphQL\Support\SelectFields;

class ListOrganizationTeachersQuery extends BaseQuery
{
    public const NAME = 'listOrganizationTeachers';

    public function __construct(
        protected TeachersRepository $teachersRepository
    )
    {
        $this->setOrganizationGuard();
        $this->setPermissionsGuard(app(ListTeachersPermission::class));
    }

    public function type(): GraphQLType
    {
        return TeacherType::paginate();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): LengthAwarePaginator
    {
        /**
         * @var Organization $organization
         */
        $organization = $this->getAuthUser();

        return $this->teachersRepository->getTeachersByOrganization(
            $organization->id,
            $fields->getRelations(),
            $args,
        );
    }
}
