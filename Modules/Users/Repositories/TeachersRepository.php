<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Repositories\AbstractBaseRepository;
use Modules\Users\Models\BaseAuthenticatableUser;
use Modules\Users\Models\Teacher;

/**
 * @extends AbstractBaseRepository<Teacher>
 * @implements BaseAuthenticatableRepositoryInterface<Teacher>
 */
class TeachersRepository extends AbstractBaseRepository implements BaseAuthenticatableRepositoryInterface
{
    public function __construct(protected Teacher $model)
    {
    }

    public function getModel(): BaseAuthenticatableUser
    {
        return $this->model;
    }

    protected function modelQuery(): FilterableModelInterface|Builder
    {
        return $this->getModel()->newQuery();
    }

    public function findByEmail(string $email): ?Teacher
    {
        return $this->modelQuery()->where('email', $email)->first();
    }

    public function findByPhone(string $phone): Teacher
    {
        return $this->modelQuery()->where('phone', $phone)->first();
    }

    public function findByEmailOrPhone(?string $email, ?string $phone): ?Teacher
    {
        return $this->modelQuery()->where('email', $email)->orWhere('phone', $phone)->first();
    }

    /**
     * @param array $relations
     * @param array $filters
     * @return LengthAwarePaginator<Teacher>
     */
    public function getTeachersInOrganizations(
        array $relations = [],
        array $filters = [],
    ): LengthAwarePaginator
    {
        $query = $this->modelQuery()
            ->whereNotNull('organization_id')
            ->filter($filters)
            ->with($relations);

        return $query->paginate(
            perPage: $this->getPerPage($filters),
            page: $this->getPage($filters)
        );
    }

    /**
     * @param int $organizationId
     * @param array $relations
     * @param array $filters
     * @return LengthAwarePaginator<Teacher>
     */
    public function getTeachersByOrganization(
        int $organizationId,
        array $relations = [],
        array $filters = [],
    ): LengthAwarePaginator
    {
        $query = $this->modelQuery()
            ->where('organization_id', $organizationId)
            ->filter($filters)
            ->with($relations);

        return $query->paginate(
            perPage: $this->getPerPage($filters),
            page: $this->getPage($filters)
        );
    }

    /**
     * @param int $teacherId
     * @param int $organizationId
     * @param array $relations
     * @param array $filters
     * @return Teacher|null
     */
    public function findTeacherByOrganization(
        int $teacherId,
        int $organizationId,
        array $relations = [],
        array $filters = [],
    ): ?Teacher
    {
        $query = $this->modelQuery()
            ->where('organization_id', $organizationId)
            ->filter($filters)
            ->with($relations);

        return $query->first();
    }
}
