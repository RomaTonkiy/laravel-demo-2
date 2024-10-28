<?php

namespace Modules\Users\Interfaces;

use Modules\Users\Models\BaseAuthenticatableUser;
use Spatie\LaravelData\Data;

interface UserServiceInterface
{
    public function create(Data $dto): BaseAuthenticatableUser;

    public function update(Data $dto): BaseAuthenticatableUser;

    public function delete(int $id): ?bool;
}
