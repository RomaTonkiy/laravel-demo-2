<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Organizations;

use Modules\Auth\GraphQL\Mutations\Common\BaseLogoutMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\OrganizationAuthService;
use Modules\Users\Models\Organization;

class OrganizationLogoutMutation extends BaseLogoutMutation
{
    public const NAME = 'organizationLogout';

    public const DESCRIPTION = 'Logout organization';

    protected function getAuthService(): AuthService
    {
        return app(OrganizationAuthService::class);
    }

    protected function getGuard(): string
    {
        return Organization::GUARD;
    }
}
