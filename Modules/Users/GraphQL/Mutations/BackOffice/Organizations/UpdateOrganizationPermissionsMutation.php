<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Organizations;

use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUpdateUserPermissionsMutation;
use Modules\Users\Permissions\Organizations\ManagePermissions\UpdateOrganizationsPermissionsPermission;
use Modules\Users\Repositories\OrganizationsRepository;

class UpdateOrganizationPermissionsMutation extends BaseUpdateUserPermissionsMutation
{
    public const NAME = 'updateOrganizationPermissions';

    public function __construct(
        PermissionService $service,
        OrganizationsRepository $repository
    )
    {
        $this->setPermissionsGuard(app(UpdateOrganizationsPermissionsPermission::class));

        parent::__construct($service, $repository);
    }
}
