<?php

namespace Modules\Users\Services\Teachers;

use Illuminate\Validation\ValidationException;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\Teacher;
use Modules\Users\Repositories\TeachersRepository;
use Modules\Users\Services\Teachers\DTO\CreateTeacherDTO;
use Modules\Users\Services\Teachers\DTO\TeacherRegisterDTO;
use Modules\Users\Services\Teachers\DTO\UpdateTeacherDTO;
use Spatie\LaravelData\Data;
use Throwable;

class TeachersService extends BaseServiceWithValidator implements UserServiceInterface
{
    public function __construct(
        protected TeachersRepository $repository,
        protected PermissionService  $permissionService,
    )
    {
        parent::__construct();
    }

    /**
     * @throws ValidationException
     */
    public function register(TeacherRegisterDTO $dto): Teacher
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

        $newTeacher = new Teacher();
        $newTeacher->email = $dto->email;
        $newTeacher->first_name = $dto->firstName;
        $newTeacher->last_name = $dto->lastName;
        $newTeacher->phone = $dto->phone;
        $newTeacher->password = $dto->password;
        $newTeacher->save();

        $this->permissionService->setTeacherRole($newTeacher);

        return $newTeacher;
    }

    /**
     * @throws Throwable
     */
    public function create(Data|CreateTeacherDTO $dto): BaseAuthenticatableUser
    {
        $teacherExists = $this->repository->findByEmail($dto->email);

        if ($teacherExists) {
            $this->addError('email', trans('exceptions.user_email_exists'));
        }

        $this->checkValidator();

        $newTeacher = new Teacher();

        try {
            $newTeacher->email = $dto->email;
            $newTeacher->phone = $dto->phone;
            $newTeacher->first_name = $dto->firstName;
            $newTeacher->last_name = $dto->lastName;
            $newTeacher->password = $dto->password;
            $newTeacher->organization_id = $dto->organizationId;
            $newTeacher->save();

            $this->permissionService->setTeacherRole($newTeacher);
        } catch (Throwable $e) {
            $newTeacher->delete();

            throw $e;
        }

        return $newTeacher;
    }

    public function update(Data|UpdateTeacherDTO $dto): BaseAuthenticatableUser
    {
        /**
         * @var $teacher Teacher
         */
        $teacher = $this->repository->findOrFailById($dto->id);

        $teacher->first_name = $dto->firstName;
        $teacher->last_name = $dto->lastName;
        $teacher->phone = $dto->phone;

        if ($dto->password) {
            $teacher->password = $dto->password;
        }

        $teacher->save();

        return $teacher;
    }

    public function delete(int $id): ?bool
    {
        $teacher = $this->repository->findOrFailById($id);

        return $teacher->delete();
    }
}
