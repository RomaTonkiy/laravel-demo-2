<?php

namespace Modules\Auth\GraphQL\Mutations\BackOffice\Admin;

use Modules\Auth\GraphQL\Mutations\Common\BaseRefreshTokenMutation;
use Modules\Auth\Services\AdminAuthService;
use Modules\Auth\Services\AuthService;

class AdminRefreshTokenMutation extends BaseRefreshTokenMutation
{
    public const NAME = 'adminRefreshToken';

    public const DESCRIPTION = 'Refresh admin token';

    protected function getAuthService(): AuthService
    {
        return app(AdminAuthService::class);
    }
}
