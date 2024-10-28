<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\UserParents;

use Modules\Auth\GraphQL\Mutations\Common\BaseLoginMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\UserParentAuthService;

class UserParentLoginMutation extends BaseLoginMutation
{
    public const NAME = 'userParentLogin';

    public const DESCRIPTION = 'Login parent';

    protected function getAuthService(): AuthService
    {
        return app(UserParentAuthService::class);
    }
}
