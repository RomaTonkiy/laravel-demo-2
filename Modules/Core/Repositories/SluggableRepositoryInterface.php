<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel
 */
interface SluggableRepositoryInterface
{
    /**
     * @param string $slug
     * @param int|null $exceptId
     * @param array $relations
     * @return TModel|null
     */
    public function findBySlug(
        string $slug,
        int $exceptId = null,
        array $relations = []
    ): Model|null;
}
