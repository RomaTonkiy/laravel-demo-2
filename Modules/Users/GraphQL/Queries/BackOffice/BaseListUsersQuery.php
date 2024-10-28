<?php

namespace Modules\Users\GraphQL\Queries\BackOffice;

use GraphQL\Type\Definition\ResolveInfo;
use Modules\Core\GraphQL\Queries\BaseQuery;
use Modules\Core\Repositories\AbstractBaseRepository;
use Rebing\GraphQL\Support\SelectFields;

abstract class BaseListUsersQuery extends BaseQuery
{
    public function __construct(
        protected AbstractBaseRepository $repository
    )
    {
        $this->setAdminGuard();
    }

    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): mixed
    {
        return $this->repository->getWithPaginator($fields->getRelations(), $args);
    }
}
