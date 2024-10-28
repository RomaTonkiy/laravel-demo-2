<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Users;

use Modules\Auth\GraphQL\Mutations\Common\BaseLoginMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\UserAuthService;

class UserLoginMutation extends BaseLoginMutation
{
    public const NAME = 'userLogin';

    public const DESCRIPTION = 'Login user';

    protected function getAuthService(): AuthService
    {
        return app(UserAuthService::class);
    }
}
