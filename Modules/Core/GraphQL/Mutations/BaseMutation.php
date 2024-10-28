<?php

namespace Modules\Core\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Auth\Traits\AuthGuardsTrait;
use Modules\Core\Traits\GraphQL\BaseAttributesTrait;
use Modules\Core\Traits\GraphQL\ThrowableResolverTrait;
use Rebing\GraphQL\Support\Mutation;

abstract class BaseMutation extends Mutation
{
    use AuthGuardsTrait;
    use BaseAttributesTrait;
    use ThrowableResolverTrait;

    public const NAME = '';
    public const DESCRIPTION = '';

    public function authorize(
        mixed $root,
        array $args,
        mixed $ctx,
        ResolveInfo $resolveInfo = null,
        Closure $getSelectFields = null
    ): bool {
        return empty($this->permissions) || $this->can($this->permissions);
    }

    abstract public function type(): Type;
}
