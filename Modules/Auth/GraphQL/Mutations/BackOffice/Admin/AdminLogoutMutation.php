<?php

namespace Modules\Auth\GraphQL\Mutations\BackOffice\Admin;

use Modules\Auth\GraphQL\Mutations\Common\BaseLogoutMutation;
use Modules\Auth\Services\AdminAuthService;
use Modules\Auth\Services\AuthService;
use Modules\Users\Models\Admin;

class AdminLogoutMutation extends BaseLogoutMutation
{
    public const NAME = 'adminLogout';

    public const DESCRIPTION = 'Logout admin';

    protected function getAuthService(): AuthService
    {
        return app(AdminAuthService::class);
    }

    protected function getGuard(): string
    {
        return Admin::GUARD;
    }
}
