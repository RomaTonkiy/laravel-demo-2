<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Organizations;

use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUserPermissionsQuery;
use Modules\Users\Permissions\Organizations\ManagePermissions\ListOrganizationsPermissionsPermission;
use Modules\Users\Repositories\OrganizationsRepository;

class ListOrganizationPermissionsQuery extends BaseListUserPermissionsQuery
{
    public const NAME = 'listOrganizationPermissions';

    public function __construct(PermissionService $service, OrganizationsRepository $repository)
    {
        $this->setPermissionsGuard([
            app(ListPermissionsPermission::class),
            app(ListOrganizationsPermissionsPermission::class),
        ]);

        parent::__construct($service, $repository);
    }
}
