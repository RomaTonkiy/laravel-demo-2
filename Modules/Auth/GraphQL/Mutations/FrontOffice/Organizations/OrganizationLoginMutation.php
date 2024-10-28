<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Organizations;

use Modules\Auth\GraphQL\Mutations\Common\BaseLoginMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\OrganizationAuthService;

class OrganizationLoginMutation extends BaseLoginMutation
{
    public const NAME = 'organizationLogin';

    public const DESCRIPTION = 'Login organization';

    protected function getAuthService(): AuthService
    {
        return app(OrganizationAuthService::class);
    }
}
