<?php

namespace Modules\Core\Services;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaCollectionsService extends BaseServiceWithValidator
{
    public const MAX_FILE_SIZE = 1024 * 1024 * 10; // 10 MB

    public function __construct(
        private readonly HasMedia $modelWithMedia
    )
    {
        parent::__construct();
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addMediaToCollection(string $collectionName, UploadedFile $file): Media
    {
        $this->checkValidator();

        return $this->modelWithMedia
            ->addMedia($file)
            ->toMediaCollection($collectionName);
    }

    public function clearMediaCollection(string $collectionName): void
    {
        $this->modelWithMedia->clearMediaCollection($collectionName);
    }
}
