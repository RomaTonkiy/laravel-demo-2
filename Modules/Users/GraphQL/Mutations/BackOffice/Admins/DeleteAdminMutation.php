<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Admins;

use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserDeleteMutation;
use Modules\Users\Permissions\Admins\DeleteAdminPermission;
use Modules\Users\Services\Admins\AdminsService;

class DeleteAdminMutation extends BaseUserDeleteMutation
{
    public const NAME = 'deleteAdmin';

    public function __construct(
        AdminsService $service,
    )
    {
        $this->setPermissionsGuard(app(DeleteAdminPermission::class));

        parent::__construct($service);
    }
}
