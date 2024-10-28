<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Repositories\AbstractBaseRepository;
use Modules\Users\Models\Admin;
use Modules\Users\Models\BaseAuthenticatableUser;

/**
 * @extends AbstractBaseRepository<Admin>
 * @implements BaseAuthenticatableRepositoryInterface<Admin>
 */
class AdminsRepository extends AbstractBaseRepository implements BaseAuthenticatableRepositoryInterface
{
    public function __construct(protected Admin $model)
    {
    }

    protected function modelQuery(): FilterableModelInterface|Builder
    {
        return $this->getModel()->newQuery();
    }

    public function findByEmail(string $email): Admin|Model|null
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }

    public function findByPhone(string $phone): Admin|Model
    {
        return $this->model->newQuery()->where('phone', $phone)->first();
    }

    public function getModel(): BaseAuthenticatableUser
    {
        return $this->model;
    }
}
