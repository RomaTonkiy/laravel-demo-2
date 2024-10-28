<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Teachers;

use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUpdateUserPermissionsMutation;
use Modules\Users\Permissions\Teachers\ManagePermissions\UpdateTeachersPermissionsPermission;
use Modules\Users\Repositories\TeachersRepository;

class UpdateTeacherPermissionsMutation extends BaseUpdateUserPermissionsMutation
{
    public const NAME = 'updateTeacherPermissions';

    public function __construct(
        PermissionService  $service,
        TeachersRepository $repository
    )
    {
        $this->setPermissionsGuard(app(UpdateTeachersPermissionsPermission::class));

        parent::__construct($service, $repository);
    }
}
