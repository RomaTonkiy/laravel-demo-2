<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Users;

use Modules\Auth\GraphQL\Mutations\Common\BaseLogoutMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\UserAuthService;
use Modules\Users\Models\User;

class UserLogoutMutation extends BaseLogoutMutation
{
    public const NAME = 'userLogout';

    public const DESCRIPTION = 'Logout user';

    protected function getAuthService(): AuthService
    {
        return app(UserAuthService::class);
    }


    protected function getGuard(): string
    {
        return User::GUARD;
    }
}
