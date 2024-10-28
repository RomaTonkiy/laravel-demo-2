<?php

namespace Modules\Users\Services\UserParents;

use Illuminate\Validation\ValidationException;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\UserParent;
use Modules\Users\Repositories\UserParentsRepository;
use Modules\Users\Services\UserParents\DTO\CreateUserParentDTO;
use Modules\Users\Services\UserParents\DTO\RegisterUserParentDTO;
use Modules\Users\Services\UserParents\DTO\UpdateUserParentDTO;
use Spatie\LaravelData\Data;
use Throwable;

class UserParentsService extends  BaseServiceWithValidator implements UserServiceInterface
{
    public function __construct(
        protected UserParentsRepository $repository,
        protected PermissionService     $permissionService,
    )
    {
        parent::__construct();
    }

    /**
     * @throws ValidationException
     */
    public function register(RegisterUserParentDTO $dto): UserParent
    {
        $modelExists = $this->repository->findByEmailOrPhone($dto->email, $dto->phone);

        if ($modelExists) {
            if ($modelExists->email === $dto->email) {
                $this->addError('email', trans('exceptions.user_email_exists'));
            } elseif ($modelExists->phone === $dto->phone) {
                $this->addError('phone', trans('exceptions.user_phone_exists'));
            }
        }

        $this->checkValidator();

        $newUser = new UserParent();
        $newUser->user_id = $dto->user->id;
        $newUser->email = $dto->email;
        $newUser->first_name = $dto->firstName;
        $newUser->last_name = $dto->lastName;
        $newUser->phone = $dto->phone;
        $newUser->password = $dto->password;
        $newUser->save();

        $this->permissionService->setUserParentRole($newUser);

        return $newUser;
    }

    public function create(Data|CreateUserParentDTO $dto): BaseAuthenticatableUser
    {
        $userParentExists = $this->repository->findByEmail($dto->email);
        $user = $this->repository->findById($dto->userId);

        if ($userParentExists) {
            $this->addError('email', trans('exceptions.user_email_exists'));
        }

        if(!$user) {
            $this->addError('user_id', trans('exceptions.user_id_not_exists'));
        }

        $this->checkValidator();

        $newUserParent = new UserParent();

        try {
            $newUserParent->user_id = $dto->userId;
            $newUserParent->email = $dto->email;
            $newUserParent->first_name = $dto->firstName;
            $newUserParent->last_name = $dto->lastName;
            $newUserParent->password = $dto->password;
            $newUserParent->save();

            $this->permissionService->setUserParentRole($newUserParent);
        } catch (Throwable $e) {
            $newUserParent->delete();

            throw $e;
        }

        return $newUserParent;
    }

    public function update(Data|UpdateUserParentDTO $dto): BaseAuthenticatableUser
    {
        /**
         * @var $userParent UserParent
         */
        $userParent = $this->repository->findOrFailById($dto->id);

        $userParent->first_name = $dto->firstName;
        $userParent->last_name = $dto->lastName;

        if ($dto->password) {
            $userParent->password = $dto->password;
        }

        $userParent->save();

        return $userParent;
    }

    public function delete(int $id): ?bool
    {
        $userParent = $this->repository->findOrFailById($id);

        return $userParent->delete();
    }
}
