<?php

namespace Modules\Core\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Modules\Auth\Traits\AuthGuardsTrait;
use Modules\Core\Traits\GraphQL\ActiveHelperTrait;
use Modules\Core\Traits\GraphQL\BaseAttributesTrait;
use Modules\Core\Traits\GraphQL\IdsHelperTrait;
use Modules\Core\Traits\GraphQL\PaginateHelperTrait;
use Modules\Core\Traits\GraphQL\QueryTextHelperTrait;
use Modules\Core\Traits\GraphQL\SlugsHelperTrait;
use Modules\Core\Traits\GraphQL\ThrowableResolverTrait;
use Rebing\GraphQL\Support\Query;

abstract class BaseQuery extends Query
{
    // Core traits
    use BaseAttributesTrait, AuthGuardsTrait, ThrowableResolverTrait;

    // Base and common args helpers
    use IdsHelperTrait, PaginateHelperTrait;

    // For use by ancestors
    use ActiveHelperTrait, SlugsHelperTrait, QueryTextHelperTrait;

    public const NAME = '';
    public const DESCRIPTION = '';

    public function authorize(
        mixed       $root,
        array       $args,
        mixed       $ctx,
        ResolveInfo $resolveInfo = null,
        Closure     $getSelectFields = null
    ): bool
    {
        return empty($this->permissions) || $this->can($this->permissions);
    }

    public function args(): array
    {
        return array_merge(
            $this->getIdArgs(),
            $this->getIdsArgs(),
            $this->getPaginateArgs(),
        );
    }
}
