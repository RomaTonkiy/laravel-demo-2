<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Teachers;

use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserDeleteMutation;
use Modules\Users\Permissions\Teachers\DeleteTeacherPermission;
use Modules\Users\Services\Teachers\TeachersService;

class DeleteTeacherMutation extends BaseUserDeleteMutation
{
    public const NAME = 'deleteTeacher';

    public function __construct(
        TeachersService $service,
    )
    {
        $this->setPermissionsGuard(app(DeleteTeacherPermission::class));

        parent::__construct($service);
    }
}
