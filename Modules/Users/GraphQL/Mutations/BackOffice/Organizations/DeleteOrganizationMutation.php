<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Organizations;

use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserDeleteMutation;
use Modules\Users\Permissions\Organizations\DeleteOrganizationPermission;
use Modules\Users\Services\Organizations\OrganizationsService;

class DeleteOrganizationMutation extends BaseUserDeleteMutation
{
    public const NAME = 'deleteOrganization';

    public function __construct(
        OrganizationsService $service,
    )
    {
        $this->setPermissionsGuard(app(DeleteOrganizationPermission::class));

        parent::__construct($service);
    }
}
