<?php

namespace Modules\Courses\GraphQL\Mutations\BackOffice\CourseCategory\Files;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Core\GraphQL\Types\UploadType;
use Modules\Courses\Permissions\Categories\UpdateCourseCategoriesPermission;
use Modules\Courses\Services\CoursesCategoriesService;
use Rebing\GraphQL\Support\SelectFields;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UploadCourseCategoryBannerMutation extends BaseMutation
{
    public const NAME = 'uploadCourseCategoryBanner';

    public const DESCRIPTION = 'Upload course category banner. Returns url of uploaded file.';

    public function __construct(
        protected CoursesCategoriesService $coursesService
    )
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(
            app(UpdateCourseCategoriesPermission::class)
        );
    }

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => NonNullType::id(),
                'description' => 'Course category id',
            ],
            'file' => [
                'type' => UploadType::type(),
                'description' => 'File to upload. If empty - file will be deleted.',
            ],
        ];
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): ?string
    {
        return $this->coursesService->updateBannerImage($args['id'], $args['file']);
    }
}
