<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Teachers;

use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUsersQuery;
use Modules\Users\GraphQL\Types\TeacherType;
use Modules\Users\Permissions\Teachers\ListTeachersPermission;
use Modules\Users\Repositories\TeachersRepository;

class ListTeachersQuery extends BaseListUsersQuery
{
    public const NAME = 'listTeachers';

    public function __construct(
        TeachersRepository $repository
    )
    {
        $this->setPermissionsGuard(app(ListTeachersPermission::class));

        parent::__construct($repository);
    }

    public function type(): GraphQLType
    {
        return TeacherType::paginate();
    }
}
