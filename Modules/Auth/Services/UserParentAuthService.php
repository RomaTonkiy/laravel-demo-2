<?php

namespace Modules\Auth\Services;

use Modules\Users\Repositories\UserParentsRepository;

class UserParentAuthService extends AuthService
{
    public function __construct(UserParentsRepository $authenticatableRepository, PassportService $passportService)
    {
        parent::__construct($authenticatableRepository, $passportService);
    }
}
