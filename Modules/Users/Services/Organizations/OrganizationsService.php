<?php

namespace Modules\Users\Services\Organizations;

use Illuminate\Validation\ValidationException;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Permissions\Services\PermissionService;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\Organization;
use Modules\Users\Repositories\OrganizationsRepository;
use Modules\Users\Services\Organizations\DTO\CreateOrganizationDTO;
use Modules\Users\Services\Organizations\DTO\OrganizationRegisterDTO;
use Modules\Users\Services\Organizations\DTO\UpdateOrganizationDTO;
use Spatie\LaravelData\Data;
use Throwable;

class OrganizationsService extends BaseServiceWithValidator implements UserServiceInterface
{
    public function __construct(
        protected OrganizationsRepository  $repository,
        protected PermissionService $permissionService,
    )
    {
        parent::__construct();
    }

    /**
     * @throws ValidationException
     */
    public function register(OrganizationRegisterDTO $dto): Organization
    {
        $modelExists = $this->repository->findByEmail($dto->email);

        if ($modelExists) {
                $this->addError('email', trans('exceptions.user_email_exists'));
        }

        $this->checkValidator();

        $newOrganization = new Organization();
        $newOrganization->email = $dto->email;
        $newOrganization->name = $dto->name;
        $newOrganization->password = $dto->password;
        $newOrganization->save();

        $this->permissionService->setOrganizationRole($newOrganization);

        return $newOrganization;
    }

    public function create(Data|CreateOrganizationDTO $dto): BaseAuthenticatableUser
    {
        $organizationExists = $this->repository->findByEmail($dto->email);

        if ($organizationExists) {
            $this->addError('email', trans('exceptions.user_email_exists'));
        }

        $this->checkValidator();

        $newOrganization = new Organization();

        try {
            $newOrganization->email = $dto->email;
            $newOrganization->name = $dto->name;
            $newOrganization->password = $dto->password;
            $newOrganization->save();

            $this->permissionService->setOrganizationRole($newOrganization);
        } catch (Throwable $e) {
            $newOrganization->delete();

            throw $e;
        }

        return $newOrganization;
    }

    public function update(Data|UpdateOrganizationDTO $dto): BaseAuthenticatableUser
    {
        /**
         * @var $organization Organization
         */
        $organization = $this->repository->findOrFailById($dto->id);

        $organization->name = $dto->name;

        if ($dto->password) {
            $organization->password = $dto->password;
        }

        $organization->save();

        return $organization;
    }

    public function delete(int $id): ?bool
    {
        $organization = $this->repository->findOrFailById($id);

        return $organization->delete();
    }
}
