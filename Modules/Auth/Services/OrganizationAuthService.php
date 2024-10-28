<?php

namespace Modules\Auth\Services;

use Modules\Users\Repositories\OrganizationsRepository;

class OrganizationAuthService extends AuthService
{
    public function __construct(OrganizationsRepository $authenticatableRepository, PassportService $passportService)
    {
        parent::__construct($authenticatableRepository, $passportService);
    }
}
