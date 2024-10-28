<?php

namespace Modules\Auth\GraphQL\Mutations\FrontOffice\Teachers;

use Modules\Auth\GraphQL\Mutations\Common\BaseLogoutMutation;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Services\TeacherAuthService;
use Modules\Users\Models\Teacher;

class TeacherLogoutMutation extends BaseLogoutMutation
{
    public const NAME = 'teacherLogout';

    public const DESCRIPTION = 'Logout teacher';

    protected function getAuthService(): AuthService
    {
        return app(TeacherAuthService::class);
    }

    protected function getGuard(): string
    {
        return Teacher::GUARD;
    }
}
