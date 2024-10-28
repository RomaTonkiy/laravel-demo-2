<?php

namespace Modules\Courses\Services\DTO\Category;

use Modules\Core\DTO\TranslatableFieldDTO;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CourseCategoryDTO extends Data
{
    public function __construct(
        #[DataCollectionOf(TranslatableFieldDTO::class)]
        public DataCollection $name,

        public ?string $slug,

        #[DataCollectionOf(TranslatableFieldDTO::class)]
        public ?DataCollection $metaTitle,

        #[DataCollectionOf(TranslatableFieldDTO::class)]
        public ?DataCollection $metaDescription,

        #[DataCollectionOf(TranslatableFieldDTO::class)]
        public ?DataCollection $shortDescription,

        #[DataCollectionOf(TranslatableFieldDTO::class)]
        public ?DataCollection $description,

        public ?int $parentId,
    )
    {
    }

    public static function createFromInputArgs(array $args): self
    {
        return self::from([
            'name' => $args['name'],
            'slug' => $args['slug'] ?? null,
            'metaTitle' => $args['meta_title'] ?? null,
            'metaDescription' => $args['meta_description'] ?? null,
            'shortDescription' => $args['short_description'] ?? null,
            'description' => $args['description'] ?? null,
            'parentId' => $args['parent_id'] ?? null,
        ]);
    }
}
