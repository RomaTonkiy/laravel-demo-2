<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Organizations;

use GraphQL\Type\Definition\Type;
use Modules\Users\GraphQL\Mutations\BackOffice\Abstract\BaseUserCreateMutation;
use Modules\Users\GraphQL\Types\OrganizationType;
use Modules\Users\Permissions\Organizations\CreateOrganizationPermission;
use Modules\Users\Services\Organizations\DTO\CreateOrganizationDTO;
use Modules\Users\Services\Organizations\OrganizationsService;
use Spatie\LaravelData\Data;

class CreateOrganizationMutation extends BaseUserCreateMutation
{
    public const NAME = 'createOrganization';

    public function __construct(
        OrganizationsService $service,
    )
    {
        $this->setPermissionsGuard(app(CreateOrganizationPermission::class));

        parent::__construct($service);
    }

    public function type(): Type
    {
        return OrganizationType::nonNullType();
    }

    protected function getDTO(array $args): Data
    {
        return CreateOrganizationDTO::from([
            'email' => $args['email'],
            'name' => $args['name'],
            'password' => $args['password'],
        ]);
    }
}
