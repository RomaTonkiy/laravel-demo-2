<?php

namespace Modules\Core\GraphQL\Schemas\Common;

use Modules\Core\GraphQL\Types\Enums\AvailableLocalesEnum;
use Modules\Core\GraphQL\Types\Fields\TranslatableField;
use Modules\Core\GraphQL\Types\Inputs\TranslatableFieldInput;
use Modules\Core\GraphQL\Types\TranslatableFieldType;
use Modules\Core\GraphQL\Types\UploadType;
use Nwidart\Modules\Module;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class CoreCommonSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            // region Types
            'types' => [
                TranslatableFieldType::class,
                TranslatableFieldInput::class,

                AvailableLocalesEnum::class,

                UploadType::class,
            ],
            // endregion
        ];
    }

    protected function getDefaultSchemaClassFromModule(Module $module): string
    {
        return config('modules.namespace') . '\\'. $module->getName() . '\\GraphQL\\Schemas\\' . $module->getName() . 'DefaultSchema';
    }

    protected function getBackOfficeSchemaClassFromModule(Module $module): string
    {
        return config('modules.namespace') . '\\'. $module->getName() . '\\GraphQL\\Schemas\\' . $module->getName() . 'BackOfficeSchema';
    }
}
