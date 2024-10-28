<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\BaseAuthenticatableUser;

/**
 * @template TModel
 */
interface BaseAuthenticatableRepositoryInterface
{
    /**
     * @param string $email
     * @return TModel|null
     */
    public function findByEmail(string $email): ?Model;

    /**
     * @return BaseAuthenticatableUser|TModel
     */
    public function getModel(): BaseAuthenticatableUser;
}
