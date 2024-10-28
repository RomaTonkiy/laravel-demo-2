<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Admins;

use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUsersQuery;
use Modules\Users\GraphQL\Types\AdminType;
use Modules\Users\Permissions\Admins\ListAdminsPermission;
use Modules\Users\Repositories\AdminsRepository;

class ListAdminsQuery extends BaseListUsersQuery
{
    public const NAME = 'listAdmins';

    public function __construct(
        AdminsRepository $repository
    )
    {
        $this->setPermissionsGuard(app(ListAdminsPermission::class));

        parent::__construct($repository);
    }

    public function type(): GraphQLType
    {
        return AdminType::paginate();
    }
}
