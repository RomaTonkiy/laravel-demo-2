<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\UserParents;

use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUsersQuery;
use Modules\Users\GraphQL\Types\UserParentType;
use Modules\Users\Permissions\UserParents\ListUserParentsPermission;
use Modules\Users\Repositories\UserParentsRepository;

class ListUserParentsQuery extends BaseListUsersQuery
{
    public const NAME = 'listUserParents';

    public function __construct(
        UserParentsRepository $repository
    )
    {
        $this->setPermissionsGuard(app(ListUserParentsPermission::class));

        parent::__construct($repository);
    }

    public function type(): GraphQLType
    {
        return UserParentType::paginate();
    }
}
