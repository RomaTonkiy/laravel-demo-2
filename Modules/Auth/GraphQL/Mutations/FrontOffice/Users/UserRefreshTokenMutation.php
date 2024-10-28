<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Users;

use Modules\Auth\GraphQL\Mutations\Common\BaseRefreshTokenMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\UserAuthService;

class UserRefreshTokenMutation extends BaseRefreshTokenMutation
{
    public const NAME = 'userRefreshToken';

    public const DESCRIPTION = 'Refresh user token';

    protected function getAuthService(): AuthService
    {
        return app(UserAuthService::class);
    }
}
