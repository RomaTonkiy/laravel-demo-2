<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Abstract;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\Interfaces\UserServiceInterface;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

class BaseUserDeleteMutation extends BaseMutation
{
    public const NAME = 'baseDeleteUser';

    public function __construct(
        protected UserServiceInterface $service,
    )
    {
        $this->setAdminGuard();
    }

    public function type(): Type
    {
        return NonNullType::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
                'description' => 'User ID.',
            ],
        ];
    }

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): bool
    {
        return $this->service->delete($args['id']);
    }
}
