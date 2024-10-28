<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\UserParents;

use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUserPermissionsQuery;
use Modules\Users\Permissions\UserParents\ManagePermissions\ListUserParentsPermissionsPermission;
use Modules\Users\Repositories\UserParentsRepository;

class ListUserParentPermissionsQuery extends BaseListUserPermissionsQuery
{
    public const NAME = 'listUserParentPermissions';

    public function __construct(PermissionService $service, UserParentsRepository $repository)
    {
        $this->setPermissionsGuard([
            app(ListPermissionsPermission::class),
            app(ListUserParentsPermissionsPermission::class),
        ]);

        parent::__construct($service, $repository);
    }
}
