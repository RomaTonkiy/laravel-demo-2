<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Teachers;

use Modules\Permissions\Permissions\Permissions\ListPermissionsPermission;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUserPermissionsQuery;
use Modules\Users\Permissions\Teachers\ManagePermissions\ListTeachersPermissionsPermission;
use Modules\Users\Repositories\TeachersRepository;

class ListTeacherPermissionsQuery extends BaseListUserPermissionsQuery
{
    public const NAME = 'listTeacherPermissions';

    public function __construct(PermissionService $service, TeachersRepository $repository)
    {
        $this->setPermissionsGuard([
            app(ListPermissionsPermission::class),
            app(ListTeachersPermissionsPermission::class),
        ]);

        parent::__construct($service, $repository);
    }
}
