<?php

namespace Modules\Auth\GraphQL\Mutations\BackOffice\Admin;

use Modules\Auth\GraphQL\Mutations\Common\BaseLoginMutation;
use Modules\Auth\Services\AdminAuthService;
use Modules\Auth\Services\AuthService;

class AdminLoginMutation extends BaseLoginMutation
{
    public const NAME = 'adminLogin';

    public const DESCRIPTION = 'Login admin';

    protected function getAuthService(): AuthService
    {
        return app(AdminAuthService::class);
    }
}
