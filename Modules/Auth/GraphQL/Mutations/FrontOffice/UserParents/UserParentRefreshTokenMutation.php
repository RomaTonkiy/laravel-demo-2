<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\UserParents;

use Modules\Auth\GraphQL\Mutations\Common\BaseRefreshTokenMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\UserParentAuthService;

class UserParentRefreshTokenMutation extends BaseRefreshTokenMutation
{
    public const NAME = 'userParentRefreshToken';

    public const DESCRIPTION = 'Refresh parent token';

    protected function getAuthService(): AuthService
    {
        return app(UserParentAuthService::class);
    }
}
