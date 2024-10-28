<?php

namespace Modules\Users\Services\Users;

use App\Events\Users\UserRegisteredEvent;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\User;
use Modules\Users\Repositories\UsersRepository;
use Modules\Users\Services\Users\DTO\CreateUserDTO;
use Modules\Users\Services\Users\DTO\UpdateUserDTO;
use Modules\Users\Services\Users\DTO\UserRegisterDTO;
use Spatie\LaravelData\Data;
use Throwable;

class UsersService extends BaseServiceWithValidator implements UserServiceInterface
{
    public function __construct(
        protected UsersRepository   $repository,
        protected PermissionService $permissionService,
    )
    {
        parent::__construct();
    }

    /**
     * @throws ValidationException
     */
    public function register(UserRegisterDTO $dto): User
    {
        $userExists = $this->repository->findByEmailOrPhone($dto->email, $dto->phone);

        if ($userExists) {
            if ($userExists->email === $dto->email) {
                $this->addError('email', trans('exceptions.user_email_exists'));
            } elseif ($userExists->phone === $dto->phone) {
                $this->addError('phone', trans('exceptions.user_phone_exists'));
            }
        }

        $this->checkValidator();

        $newUser = new User();
        $newUser->email = $dto->email;
        $newUser->first_name = $dto->firstName;
        $newUser->last_name = $dto->lastName;
        $newUser->phone = $dto->phone;
        $newUser->password = $dto->password;
        $newUser->save();

        UserRegisteredEvent::dispatch($newUser);

        $this->permissionService->setUserRole($newUser);

        return $newUser;
    }

    public function create(Data|CreateUserDTO $dto): BaseAuthenticatableUser
    {
        $userExists = $this->repository->findByEmail($dto->email);

        if ($userExists) {
            $this->addError('email', trans('exceptions.user_email_exists'));
        }

        $this->checkValidator();

        $newUser = new User();

        try {
            $newUser->email = $dto->email;
            $newUser->first_name = $dto->firstName;
            $newUser->last_name = $dto->lastName;
            $newUser->password = $dto->password;
            $newUser->save();

            $this->permissionService->setUserRole($newUser);
        } catch (Throwable $e) {
            $newUser->delete();

            throw $e;
        }

        return $newUser;
    }

    public function update(Data|UpdateUserDTO $dto): BaseAuthenticatableUser
    {
        /**
         * @var $user User
         */
        $user = $this->repository->findOrFailById($dto->id);

        $user->first_name = $dto->firstName;
        $user->last_name = $dto->lastName;

        if ($dto->password) {
            $user->password = $dto->password;
        }

        $user->save();

        return $user;
    }

    public function delete(int $id): ?bool
    {
        $user = $this->repository->findOrFailById($id);

        return $user->delete();
    }
}
