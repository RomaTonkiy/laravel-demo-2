<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Admins;

use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUserPermissionsQuery;
use Modules\Users\Permissions\Admins\ManagePermissions\ListAdminsPermissionsPermission;
use Modules\Users\Repositories\AdminsRepository;

class ListAdminPermissionsQuery extends BaseListUserPermissionsQuery
{
    public const NAME = 'listAdminPermissions';

    public function __construct(PermissionService $service, AdminsRepository $repository)
    {
        $this->setPermissionsGuard([
            app(ListPermissionsPermission::class),
            app(ListAdminsPermissionsPermission::class),
        ]);

        parent::__construct($service, $repository);
    }
}
