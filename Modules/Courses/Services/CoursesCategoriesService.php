<?php

namespace Modules\Courses\Services;

use Illuminate\Http\UploadedFile;
use Modules\Core\Services\BaseServiceWithValidator;
use Modules\Core\Services\MediaCollectionsService;
use Modules\Core\Transformers\TranslatableFieldInputTransformer;
use Modules\Courses\Models\CourseCategory;
use Modules\Courses\Repositories\CourseCategoriesRepository;
use Modules\Courses\Services\DTO\Category\CourseCategoryDTO;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CoursesCategoriesService extends BaseServiceWithValidator
{
    public function __construct(
        protected CourseCategoriesRepository $courseCategoriesRepository
    )
    {
        parent::__construct();
    }

    public function create(CourseCategoryDTO $dto): CourseCategory
    {
        $this->checkSlugExists($dto->slug);

        $this->checkParentExists($dto->parentId);

        $this->checkValidator();

        $category = new CourseCategory();

        $category = $this->fillFromDTO($category, $dto);

        $category->save();

        return $category->refresh();
    }

    public function update(int $id, CourseCategoryDTO $dto): CourseCategory
    {
        $this->checkSlugExists($dto->slug, $id);

        $this->checkParentExists($dto->parentId);

        $category = $this->courseCategoriesRepository->findById($id);

        if (!$category) {
            $this->addError('id', trans('validation.exists', ['attribute' => 'id']));
        }

        $this->checkValidator();

        $category = $this->fillFromDTO($category, $dto);

        $category->save();

        return $category->refresh();
    }

    public function updateSorting(int $id, int $sort): int
    {
        $category = $this->courseCategoriesRepository->findById($id);

        if (!$category) {
            $this->addError('id', trans('validation.exists', ['attribute' => 'id']));
        }

        $this->checkValidator();

        $category->sort = $sort;

        $category->save();

        return $category->sort;
    }

    public function delete(int $id): bool
    {
        $category = $this->courseCategoriesRepository->findById($id);

        if (!$category) {
            $this->addError('id', trans('validation.exists', ['attribute' => 'id']));
        }

        $this->checkValidator();

        return $category->delete();
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function updatePreviewImage(int $id, ?UploadedFile $file): ?string
    {
        $category = $this->courseCategoriesRepository->findById($id);
        $collection = CourseCategory::MEDIA_COLLECTION_PREVIEW;
        $mediaCollectionService = new MediaCollectionsService($category);

        if (empty($file)) {
            $mediaCollectionService->clearMediaCollection($collection);
            return null;
        }

        $media = $mediaCollectionService->addMediaToCollection($collection, $file);

        return $media->getUrl();
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function updateBannerImage(int $id, ?UploadedFile $file): ?string
    {
        $category = $this->courseCategoriesRepository->findById($id);
        $collection = CourseCategory::MEDIA_COLLECTION_BANNER;
        $mediaCollectionService = new MediaCollectionsService($category);

        if (empty($file)) {
            $mediaCollectionService->clearMediaCollection($collection);
            return null;
        }

        $media = $mediaCollectionService->addMediaToCollection($collection, $file);

        return $media->getUrl();
    }

    protected function fillFromDTO(CourseCategory $category, CourseCategoryDTO $dto): CourseCategory
    {
        $category->name = TranslatableFieldInputTransformer::transform($dto->name);
        $category->slug = $dto->slug ?? CourseCategory::getSlug($category->name);
        $category->meta_title = TranslatableFieldInputTransformer::transform($dto->metaTitle);
        $category->meta_description = TranslatableFieldInputTransformer::transform($dto->metaDescription);
        $category->short_description = TranslatableFieldInputTransformer::transform($dto->shortDescription);
        $category->description = TranslatableFieldInputTransformer::transform($dto->description);
        $category->parent_id = $dto->parentId;

        return $category;
    }

    protected function checkSlugExists(string $slug = null, ?int $id = null): void
    {
        if (
            $slug
            && $this->courseCategoriesRepository->findBySlug($slug, $id)
        ) {
            $this->addError('slug', trans('validation.unique', ['attribute' => 'slug']));
        }
    }

    protected function checkParentExists(int $parentId = null): void
    {
        if (!empty($parentId)) {
            $parentCategory = $this->courseCategoriesRepository->findById($parentId);

            if (!$parentCategory) {
                $this->addError('parent_id', trans('validation.exists', ['attribute' => 'parent_id']));
            }
        }
    }
}
