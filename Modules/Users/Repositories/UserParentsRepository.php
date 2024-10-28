<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Repositories\AbstractBaseRepository;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;

/**
 * @extends AbstractBaseRepository<UserParent>
 * @implements BaseAuthenticatableRepositoryInterface<UserParent>
 */
class UserParentsRepository extends AbstractBaseRepository implements BaseAuthenticatableRepositoryInterface
{
    public function __construct(protected UserParent $model)
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

    public function findByEmail(string $email): ?UserParent
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }

    public function findByPhone(string $phone): UserParent
    {
        return $this->model->newQuery()->where('phone', $phone)->first();
    }

    public function findByEmailOrPhone(?string $email, ?string $phone): ?UserParent
    {
        return $this->model->newQuery()->where('email', $email)->orWhere('phone', $phone)->first();
    }

    public function findByUser(User $user): ?UserParent
    {
        return $this->model->newQuery()->where('user_id', $user->id)->first();
    }

    public function findByUserId(int $userId): ?UserParent
    {
        return $this->model->newQuery()->where('user_id', $userId)->first();
    }
}
