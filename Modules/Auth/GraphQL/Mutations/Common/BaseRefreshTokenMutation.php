<?php

namespace Modules\Auth\GraphQL\Mutations\Common;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Auth\DTO\AuthDataDTO;
use Modules\Auth\GraphQL\Types\AuthType;
use Modules\Auth\Services\AuthService;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

abstract class BaseRefreshTokenMutation extends BaseMutation
{
    public function type(): Type
    {
        return AuthType::type();
    }

    public function args(): array
    {
        return [
            'refresh_token' => NonNullType::string(),
        ];
    }

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): AuthDataDTO
    {
        return $this->getAuthService()->refreshToken(
            $args['refresh_token'],
        );
    }

    abstract protected function getAuthService(): AuthService;
}
