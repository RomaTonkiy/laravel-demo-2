<?php

namespace Modules\Users\GraphQL\Queries\BackOffice\Organizations;

use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Users\GraphQL\Queries\BackOffice\BaseListUsersQuery;
use Modules\Users\GraphQL\Types\OrganizationType;
use Modules\Users\Permissions\Organizations\ListOrganizationsPermission;
use Modules\Users\Repositories\OrganizationsRepository;

class ListOrganizationsQuery extends BaseListUsersQuery
{
    public const NAME = 'listOrganizations';

    public function __construct(
        OrganizationsRepository $repository
    )
    {
        $this->setPermissionsGuard(app(ListOrganizationsPermission::class));

        parent::__construct($repository);
    }

    public function type(): GraphQLType
    {
        return OrganizationType::paginate();
    }
}
