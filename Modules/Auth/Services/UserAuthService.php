<?php

namespace Modules\Auth\Services;

use Modules\Users\Repositories\UsersRepository;

class UserAuthService extends AuthService
{
    public function __construct(UsersRepository $authenticatableRepository, PassportService $passportService)
    {
        parent::__construct($authenticatableRepository, $passportService);
    }
}
