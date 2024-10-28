<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Admins;

use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUpdateUserPermissionsMutation;
use Modules\Users\Permissions\Admins\ManagePermissions\UpdateAdminsPermissionsPermission;
use Modules\Users\Repositories\AdminsRepository;

class UpdateAdminPermissionsMutation extends BaseUpdateUserPermissionsMutation
{
    public const NAME = 'updateAdminPermissions';

    public function __construct(
        PermissionService $service,
        AdminsRepository $repository
    )
    {
        $this->setPermissionsGuard(app(UpdateAdminsPermissionsPermission::class));

        parent::__construct($service, $repository);
    }
}
