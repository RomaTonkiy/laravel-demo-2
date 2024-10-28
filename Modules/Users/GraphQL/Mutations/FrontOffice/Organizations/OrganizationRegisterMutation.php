<?php

namespace Modules\Users\GraphQL\Mutations\FrontOffice\Organizations;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Auth\DTO\AuthDataDTO;
use Modules\Auth\GraphQL\Types\AuthType;
use Modules\Auth\Services\OrganizationAuthService;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\Traits\GraphQL\Auth\RememberMeTrait;
use Modules\Users\Services\Organizations\DTO\OrganizationRegisterDTO;
use Modules\Users\Services\Organizations\OrganizationsService;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

class OrganizationRegisterMutation extends BaseMutation
{
    use RememberMeTrait;

    public const NAME = 'organizationRegister';

    public function __construct(
        protected OrganizationsService    $service,
        protected OrganizationAuthService $authService,
    )
    {
    }

    public function type(): Type
    {
        return AuthType::type();
    }

    public function args(): array
    {
        return array_merge([
            'name' => NonNullType::string(),
            'email' => [
                'type' => NonNullType::string(),
                'rules' => ['email'],
                'description' => 'Email address. Validated with email rule. Should be unique',
            ],
            'password' => [
                'type' => NonNullType::string(),
                'rules' => ['min:8'],
                'description' => 'Password. Validated with min:8 rule',
            ],
            'password_confirmation' => [
                'type' => NonNullType::string(),
                'rules' => ['same:password'],
                'description' => 'Password confirmation, same as password field',
            ],
        ], $this->rememberMeArgs());
    }

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): AuthDataDTO
    {
        $dto = OrganizationRegisterDTO::from([
            'email' => $args['email'],
            'name' => $args['name'],
            'password' => $args['password'],
        ]);

        $this->service->register($dto);

        return $this->authService->authenticate(
            $args['email'],
            $args['password'],
            $args['remember_me'],
        );
    }
}
