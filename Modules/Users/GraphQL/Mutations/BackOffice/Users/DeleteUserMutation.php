<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Users;

use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserDeleteMutation;
use Modules\Users\Permissions\Users\DeleteUserPermission;
use Modules\Users\Services\Users\UsersService;

class DeleteUserMutation extends BaseUserDeleteMutation
{
    public const NAME = 'deleteUser';

    public function __construct(
        UsersService $service,
    )
    {
        $this->setPermissionsGuard(app(DeleteUserPermission::class));

        parent::__construct($service);
    }
}
