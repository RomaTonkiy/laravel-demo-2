<?php

namespace Modules\Users\Services\Admins;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\Admin;
use Modules\Users\Repositories\AdminsRepository;
use Modules\Users\Services\Admins\DTO\CreateAdminDTO;
use Modules\Users\Services\Admins\DTO\UpdateAdminDTO;
use Spatie\LaravelData\Data;
use Throwable;

class AdminsService extends BaseServiceWithValidator implements UserServiceInterface
{
    public function __construct(
        protected AdminsRepository  $adminsRepository,
        protected PermissionService $permissionService,
    )
    {
        parent::__construct();
    }

    /**
     * @throws ValidationException
     * @throws Throwable
     */
    public function create(CreateAdminDTO|Data $dto): Admin
    {
        $adminExists = $this->adminsRepository->findByEmail($dto->email);

        if ($adminExists) {
            $this->addError('email', trans('exceptions.user_email_exists'));
        }

        $this->checkValidator();

        $newAdmin = new Admin();

        try {
            $newAdmin->email = $dto->email;
            $newAdmin->name = $dto->name;
            $newAdmin->password = $dto->password;
            $newAdmin->save();

            $this->permissionService->setAdminRole($newAdmin);
        } catch (Throwable $e) {
            $newAdmin->delete();

            throw $e;
        }

        return $newAdmin;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function update(UpdateAdminDTO|Data $dto): Admin
    {
        /**
         * @var $admin Admin
         */
        $admin = $this->adminsRepository->findOrFailById($dto->id);

        $admin->name = $dto->name;

        if ($dto->password) {
            $admin->password = $dto->password;
        }

        $admin->save();

        return $admin;
    }

    /**
     * @param int $id
     * @return bool|null
     *
     * @throws ModelNotFoundException
     */
    public function delete(int $id): ?bool
    {
        $admin = $this->adminsRepository->findOrFailById($id);

        return $admin->delete();
    }
}
