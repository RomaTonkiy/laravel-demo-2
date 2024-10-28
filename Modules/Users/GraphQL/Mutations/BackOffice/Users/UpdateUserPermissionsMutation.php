<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Users;

use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUpdateUserPermissionsMutation;
use Modules\Users\Permissions\Users\ManagePermissions\UpdateUsersPermissionsPermission;
use Modules\Users\Repositories\UsersRepository;

class UpdateUserPermissionsMutation extends BaseUpdateUserPermissionsMutation
{
    public const NAME = 'updateUserPermissions';

    public function __construct(
        PermissionService  $service,
        UsersRepository $repository
    )
    {
        $this->setPermissionsGuard(app(UpdateUsersPermissionsPermission::class));

        parent::__construct($service, $repository);
    }
}
