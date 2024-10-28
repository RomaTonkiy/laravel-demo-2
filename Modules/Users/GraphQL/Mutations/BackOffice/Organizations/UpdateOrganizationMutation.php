<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Organizations;

use GraphQL\Type\Definition\Type;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserUpdateMutation;
use Modules\Users\GraphQL\Types\OrganizationType;
use Modules\Users\Permissions\Organizations\UpdateOrganizationPermission;
use Modules\Users\Services\Organizations\DTO\UpdateOrganizationDTO;
use Modules\Users\Services\Organizations\OrganizationsService;
use Spatie\LaravelData\Data;

class UpdateOrganizationMutation extends BaseUserUpdateMutation
{
    public const NAME = 'updateOrganization';

    public function __construct(
        OrganizationsService $service,
    )
    {
        $this->setPermissionsGuard(app(UpdateOrganizationPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return OrganizationType::nonNullType();
    }

    protected function getDTO(array $args): Data
    {
        return UpdateOrganizationDTO::from([
            'id' => $args['id'],
            'name' => $args['name'],
            'password' => $args['password'] ?? null,
        ]);
    }
}
