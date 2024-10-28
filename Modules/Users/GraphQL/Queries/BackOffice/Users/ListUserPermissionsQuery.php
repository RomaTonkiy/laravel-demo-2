<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Users;

use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUserPermissionsQuery;
use Modules\Users\Permissions\Users\ManagePermissions\ListUsersPermissionsPermission;
use Modules\Users\Repositories\UsersRepository;

class ListUserPermissionsQuery extends BaseListUserPermissionsQuery
{
    public const NAME = 'listUserPermissions';

    public function __construct(PermissionService $service, UsersRepository $repository)
    {
        $this->setPermissionsGuard([
            app(ListPermissionsPermission::class),
            app(ListUsersPermissionsPermission::class),
        ]);

        parent::__construct($service, $repository);
    }
}
