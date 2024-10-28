<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Teachers;

use Modules\Auth\GraphQL\Mutations\Common\BaseRefreshTokenMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\TeacherAuthService;

class TeacherRefreshTokenMutation extends BaseRefreshTokenMutation
{
    public const NAME = 'teacherRefreshToken';

    public const DESCRIPTION = 'Refresh teacher token';

    protected function getAuthService(): AuthService
    {
        return app(TeacherAuthService::class);
    }
}
