<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Repositories\AbstractBaseRepository;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\User;

/**
 * @extends AbstractBaseRepository<User>
 * @implements BaseAuthenticatableRepositoryInterface<User>
 */
class UsersRepository extends AbstractBaseRepository implements BaseAuthenticatableRepositoryInterface
{
    public function __construct(protected User $model)
    {
    }

    protected function modelQuery(): FilterableModelInterface|Builder
    {
        return $this->getModel()->newQuery();
    }

    public function getModel(): BaseAuthenticatableUser
    {
        return $this->model;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }

    public function findByPhone(string $phone): User
    {
        return $this->model->newQuery()->where('phone', $phone)->first();
    }

    public function findByEmailOrPhone(?string $email, ?string $phone): ?User
    {
        return $this->model->newQuery()->where('email', $email)->orWhere('phone', $phone)->first();
    }
}
