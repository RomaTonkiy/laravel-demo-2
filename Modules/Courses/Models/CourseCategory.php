<?php

namespace Modules\Courses\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\AbstractFilterableModel;
use Modules\Core\Traits\Filterable;
use Modules\Core\Traits\HasSlug;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\InteractsWithMedia;
use Modules\Courses\Filters\CourseCategoryFilter;
use Spatie\MediaLibrary\HasMedia;

class CourseCategory extends AbstractFilterableModel implements HasMedia
{
    use SoftDeletes, HasTranslations, Filterable, HasSlug;

    use InteractsWithMedia {
        registerMediaCollections as registerMediaCollectionsTrait;
    }

    public const TABLE = 'course_categories';

    public const MEDIA_COLLECTION_PREVIEW = 'preview';
    public const MEDIA_COLLECTION_BANNER = 'banner';

    protected $table = self::TABLE;

    public array $translatable = [
        'name',
        'meta_title',
        'meta_description',
        'short_description',
        'description',
    ];

    public function childCategory(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function modelFilter(): string
    {
        return CourseCategoryFilter::class;
    }

    public function registerMediaCollections(): void
    {
        $this->registerMediaCollectionsTrait();

        $this
            ->addMediaCollection(self::MEDIA_COLLECTION_PREVIEW)
            ->singleFile();

        $this
            ->addMediaCollection(self::MEDIA_COLLECTION_BANNER)
            ->singleFile();
    }
}
