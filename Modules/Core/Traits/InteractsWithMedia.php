<?php

namespace Modules\Core\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait InteractsWithMedia
{
    use \Spatie\MediaLibrary\InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->singleFile();
    }
}
