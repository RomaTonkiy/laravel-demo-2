<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Repositories\AbstractBaseRepository;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\Organization;

/**
 * @extends AbstractBaseRepository<Organization>
 * @implements BaseAuthenticatableRepositoryInterface<Organization>
 */
class OrganizationsRepository extends AbstractBaseRepository implements BaseAuthenticatableRepositoryInterface
{
    public function __construct(protected Organization $model)
    {
    }

    public function getModel(): BaseAuthenticatableUser
    {
        return $this->model;
    }

    protected function modelQuery(): FilterableModelInterface|Builder
    {
        return $this->getModel()->newQuery();
    }

    public function findByEmail(string $email): ?Organization
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }
}
