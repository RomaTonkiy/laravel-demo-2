<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Core\Interfaces\FilterableModelInterface;
use Modules\Core\Models\AbstractFilterableModel;

/**
 * @template TModel
 * @implements BaseRepositoryInterface<TModel>
 */
abstract class AbstractBaseRepository implements BaseRepositoryInterface
{
    abstract protected function modelQuery(): FilterableModelInterface|Builder;

    /**
     * @param int $id
     * @param array $relations
     * @return AbstractFilterableModel|TModel|null
     */
    public function findById(
        int   $id,
        array $relations = []
    ): AbstractFilterableModel|Model|null
    {
        $query = $this->modelQuery()
            ->with($relations);

        return $query->find($id);
    }

    /**
     * @param int $id
     * @param array $relations
     * @return TModel
     *
     * @throws ModelNotFoundException
     */
    public function findOrFailById(
        int $id,
        array $relations = []
    ): Model
    {
        $query = $this->modelQuery()
            ->with($relations);

        return $query->findOrFail($id);
    }

    /**
     * @param array $relations
     * @param array $filters
     * @return Collection<TModel>
     */
    public function getAll(
        array $relations = [],
        array $filters = [],
    ): Collection
    {
        $query = $this->modelQuery()
            ->filter($filters)
            ->with($relations);

        return $query->get();
    }

    /**
     * @param array $relations
     * @param array $filters
     * @return LengthAwarePaginator<TModel>
     */
    public function getWithPaginator(
        array $relations = [],
        array $filters = [],
    ): LengthAwarePaginator
    {
        $query = $this->modelQuery()
            ->filter($filters)
            ->with($relations);

        return $query->paginate(
            perPage: $this->getPerPage($filters),
            page: $this->getPage($filters)
        );
    }

    public function getPerPage($filters): int
    {
        if (isset($filters['per_page'])) {
            return $filters['per_page'];
        }

        return $this->modelQuery()->getModel()->getDefaultPerPage();
    }

    public function getPage($filters): int
    {
        if (isset($filters['page'])) {
            return $filters['page'];
        }

        return 1;
    }
}
