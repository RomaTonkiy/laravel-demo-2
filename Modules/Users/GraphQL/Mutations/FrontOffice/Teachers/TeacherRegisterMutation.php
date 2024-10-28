<?php

namespace Modules\Users\GraphQL\Mutations\FrontOffice\Teachers;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Auth\DTO\AuthDataDTO;
use Modules\Auth\GraphQL\Types\AuthType;
use Modules\Auth\Services\TeacherAuthService;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\Traits\GraphQL\Auth\RememberMeTrait;
use Modules\Users\Services\Teachers\DTO\TeacherRegisterDTO;
use Modules\Users\Services\Teachers\TeachersService;
use Rebing\GraphQL\Support\SelectFields;
use Throwable;

class TeacherRegisterMutation extends BaseMutation
{
    use RememberMeTrait;

    public const NAME = 'teacherRegister';

    public function __construct(
        protected TeachersService    $service,
        protected TeacherAuthService $authService,
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
            'first_name' => NonNullType::string(),
            'last_name' => NonNullType::string(),
            'email' => [
                'type' => NonNullType::string(),
                'rules' => ['email'],
                'description' => 'Email address. Validated with email rule. Should be unique',
            ],
            'phone' => Type::string(),
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
        $dto = TeacherRegisterDTO::from([
            'email' => $args['email'],
            'firstName' => $args['first_name'],
            'lastName' => $args['last_name'],
            'password' => $args['password'],
            'phone' => $args['phone'] ?? null,
        ]);

        $this->service->register($dto);

        return $this->authService->authenticate(
            $args['email'],
            $args['password'],
            $args['remember_me'],
        );
    }
}
