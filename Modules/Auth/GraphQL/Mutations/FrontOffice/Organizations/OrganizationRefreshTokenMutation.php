<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Organizations;

use Modules\Auth\GraphQL\Mutations\Common\BaseRefreshTokenMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\OrganizationAuthService;

class OrganizationRefreshTokenMutation extends BaseRefreshTokenMutation
{
    public const NAME = 'organizationRefreshToken';

    public const DESCRIPTION = 'Refresh organization token';

    protected function getAuthService(): AuthService
    {
        return app(OrganizationAuthService::class);
    }
}
