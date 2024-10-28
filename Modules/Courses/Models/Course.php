<?php

namespace Modules\Courses\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\AbstractFilterableModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasSlug;
use Modules\Core\Traits\HasTranslations;
use Modules\Courses\Filters\CourseFilter;

class Course extends AbstractFilterableModel
{
    use SoftDeletes, HasTranslations, Filterable, HasSlug;

    public const TABLE = 'courses';

    protected $table = self::TABLE;

    public array $translatable = [
        'name',
        'meta_title',
        'meta_description',
        'short_description',
        'description',
    ];

    public function modelFilter(): string
    {
        return CourseFilter::class;
    }

    public function creator(): MorphTo
    {
        return $this->morphTo();
    }
}
