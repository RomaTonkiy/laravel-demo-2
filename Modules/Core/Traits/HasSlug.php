<?php

namespace Modules\Core\Traits;

use Spatie\Sluggable\SlugOptions;

trait HasSlug
{
    use \Spatie\Sluggable\HasSlug;

    public const SLUG_FROM_FIELD = 'name';
    public const SLUG_FIELD = 'slug';

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::SLUG_FROM_FIELD)
            ->saveSlugsTo(self::SLUG_FIELD)
            ->usingLanguage(config('app.locale'));
    }

    public static function getSlug($from): string
    {
        $self = new self();

        $self->{self::SLUG_FROM_FIELD} = $from;
        $self->generateSlug();

        return $self->{self::SLUG_FIELD};
    }
}
