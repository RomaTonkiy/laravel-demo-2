<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Teachers;

use Modules\Auth\GraphQL\Mutations\Common\BaseLoginMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\TeacherAuthService;

class TeacherLoginMutation extends BaseLoginMutation
{
    public const NAME = 'teacherLogin';

    public const DESCRIPTION = 'Login teacher';

    protected function getAuthService(): AuthService
    {
        return app(TeacherAuthService::class);
    }
}
