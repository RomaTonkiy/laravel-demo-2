<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\UserParents;

use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUpdateUserPermissionsMutation;
use Modules\Users\Permissions\UserParents\ManagePermissions\UpdateUserParentsPermissionsPermission;
use Modules\Users\Repositories\UserParentsRepository;

class UpdateUserParentPermissionsMutation extends BaseUpdateUserPermissionsMutation
{
    public const NAME = 'updateUserParentPermissions';

    public function __construct(
        PermissionService  $service,
        UserParentsRepository $repository
    )
    {
        $this->setPermissionsGuard(app(UpdateUserParentsPermissionsPermission::class));

        parent::__construct($service, $repository);
    }
}
