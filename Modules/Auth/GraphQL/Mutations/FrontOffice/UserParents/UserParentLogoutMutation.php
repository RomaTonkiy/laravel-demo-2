<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\UserParents;

use Modules\Auth\GraphQL\Mutations\Common\BaseLogoutMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\UserParentAuthService;
use Modules\Users\Models\UserParent;

class UserParentLogoutMutation extends BaseLogoutMutation
{
    public const NAME = 'userParentLogout';

    public const DESCRIPTION = 'Logout parent';

    protected function getAuthService(): AuthService
    {
        return app(UserParentAuthService::class);
    }

    protected function getGuard(): string
    {
        return UserParent::GUARD;
    }
}
