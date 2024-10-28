<?php

namespace Modules\Auth\Services;

use Modules\Users\Repositories\TeachersRepository;

class TeacherAuthService extends AuthService
{
    public function __construct(TeachersRepository $authenticatableRepository, PassportService $passportService)
    {
        parent::__construct($authenticatableRepository, $passportService);
    }
}
