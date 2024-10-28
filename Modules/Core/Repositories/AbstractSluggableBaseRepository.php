<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel
 * @extends AbstractBaseRepository<TModel>
 * @implements SluggableRepositoryInterface<TModel>
 */
abstract class AbstractSluggableBaseRepository extends AbstractBaseRepository implements SluggableRepositoryInterface
{
    /**
     * Find a model by its slug.
     *
     * @param string $slug The slug to search for.
     * @param int|null $exceptId An ID to exclude from the search.
     * @param array $relations Relationships to load with the model.
     * @return TModel|null The model found, or null.
     */
    public function findBySlug(
        string $slug,
        int $exceptId = null,
        array  $relations = []
    ): Model|null
    {
        return $this->modelQuery()
            ->where('slug', $slug)
            ->where('id', '!=', $exceptId)
            ->with($relations)
            ->first();
    }
}
