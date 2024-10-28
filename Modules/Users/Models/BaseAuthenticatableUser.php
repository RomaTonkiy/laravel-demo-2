<?php

namespace Modules\Users\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Modules\Core\Enforcer\Enforcer;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Traits\Filterable;
use ReflectionException;
use Spatie\Permission\Traits\HasRoles;

abstract class BaseAuthenticatableUser extends Authenticatable implements FilterableModelInterface
{
    use HasApiTokens, HasRoles, Filterable;

    public const GUARD = 'abstract_graph_guard';
    public const ROLE = 'abstract_role';

    /**
     * @throws ReflectionException
     */
    public function __construct() {
        Enforcer::__add(__CLASS__, get_called_class());

        parent::__construct();
    }

    public function guardName(): string
    {
        return static::GUARD;
    }

    public function getDefaultPerPage(): int
    {
        return 20;
    }
}
