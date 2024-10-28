<?php

namespace Modules\Core\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * @template TModel
 */
interface BaseRepositoryInterface
{
    /**
     * @param int $id
     * @param array $relations
     * @return TModel|null
     */
    public function findById(
        int $id,
        array $relations = []
    ): ?Model;

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
    ): Model;

    /**
     * @param array $relations
     * @param array $filters
     * @return Collection<TModel>
     */
    public function getAll(
        array $relations = [],
        array $filters = [],
    ): Collection;

    /**
     * @param array $relations
     * @param array $filters
     * @return LengthAwarePaginator<TModel>
     */
    public function getWithPaginator(
        array $relations = [],
        array $filters = [],
    ): LengthAwarePaginator;
}
