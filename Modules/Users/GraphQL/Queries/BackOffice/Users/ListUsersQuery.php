<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Users;

use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUsersQuery;
use Modules\Users\GraphQL\Types\UserType;
use Modules\Users\Permissions\Users\ListUsersPermission;
use Modules\Users\Repositories\UsersRepository;

class ListUsersQuery extends BaseListUsersQuery
{
    public const NAME = 'listUsers';

    public function __construct(
        UsersRepository $repository
    )
    {
        $this->setPermissionsGuard(app(ListUsersPermission::class));

        parent::__construct($repository);
    }

    public function type(): GraphQLType
    {
        return UserType::paginate();
    }
}
