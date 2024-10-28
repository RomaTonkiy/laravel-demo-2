<?php

namespace Modules\Auth\GraphQL\Mutations\Common;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Auth\Services\AuthService;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

abstract class BaseLogoutMutation extends BaseMutation
{
    public function type(): Type
    {
        return NonNullType::boolean();
    }

    public function authorize(mixed $root, array $args, mixed $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return $this->getAuthGuard($this->getGuard())->check();
    }

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): bool
    {
        return $this->getAuthService()->logout($this->getAuthUser());
    }

    abstract protected function getAuthService(): AuthService;

    abstract protected function getGuard(): string;
}
