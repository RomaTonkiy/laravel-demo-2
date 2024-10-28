<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\UserParents;

use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserDeleteMutation;
use Modules\Users\Permissions\UserParents\DeleteUserParentPermission;
use Modules\Users\Services\UserParents\UserParentsService;

class DeleteUserParentMutation extends BaseUserDeleteMutation
{
    public const NAME = 'deleteUserParent';

    public function __construct(
        UserParentsService $service,
    )
    {
        $this->setPermissionsGuard(app(DeleteUserParentPermission::class));

        parent::__construct($service);
    }
}
