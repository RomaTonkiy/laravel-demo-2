<?php

namespace Modules\Auth\GraphQL\Mutations\Common;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type as GraphQLType;
use Modules\Auth\DTO\AuthDataDTO;
use Modules\Auth\GraphQL\Types\AuthType;
use Modules\Auth\Services\AuthService;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\Traits\GraphQL\Auth\RememberMeTrait;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

abstract class BaseLoginMutation extends BaseMutation
{
    use RememberMeTrait;

    public function type(): GraphQLType
    {
        return AuthType::type();
    }

    public function args(): array
    {
        return array_merge([
            'email' => NonNullType::string(),
            'password' => NonNullType::string(),
        ], $this->rememberMeArgs());
    }

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): AuthDataDTO
    {
        return $this->getAuthService()->authenticate(
            $args['email'],
            $args['password'],
            $args['remember_me'],
        );
    }

    abstract protected function getAuthService(): AuthService;
}
