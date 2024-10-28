<?php

namespace Modules\Core\GraphQL\Types\Enums;

use Modules\Core\GraphQL\Types\BaseEnum;

class AvailableLocalesEnum extends BaseEnum
{
    public const NAME = 'AvailableLocalesEnum';

    public const DESCRIPTION = 'The available locales codes';

    public function values(): array
    {
        return config('app.available_locales');
    }
}
