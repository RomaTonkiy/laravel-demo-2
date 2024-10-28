<?php

namespace Modules\Auth\Services;

use Modules\Users\Repositories\AdminsRepository;

class AdminAuthService extends AuthService
{
    public function __construct(AdminsRepository $authenticatableRepository, PassportService $passportService)
    {
        parent::__construct($authenticatableRepository, $passportService);
    }
}
