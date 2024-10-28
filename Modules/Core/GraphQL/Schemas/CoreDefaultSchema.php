<?php

namespace Modules\Core\GraphQL\Schemas;

use Modules\Core\GraphQL\Schemas\Common\CoreCommonSchema;
use Nwidart\Modules\Facades\Module;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class CoreDefaultSchema extends CoreCommonSchema
{
    public function toConfig(): array
    {
        /**
         * @var \Nwidart\Modules\Module[] $modules
         */
        $modules = Module::allEnabled();
        $configs = array_merge_recursive(parent::toConfig(), [
            // region Query
            'query' => [
            ],
            // endregion

            // region Mutation
            'mutation' => [
            ],
            // endregion

            // region Types
            'types' => [
            ],
            // endregion
        ]);

        foreach ($modules as $module) {
            $defaultSchema = $this->getDefaultSchemaClassFromModule($module);

            if ($defaultSchema && class_exists($defaultSchema)) {
                $defaultSchema = new $defaultSchema;

                if (
                    $defaultSchema instanceof ConfigConvertible
                    && method_exists($defaultSchema, 'toConfig')
                    && !($defaultSchema instanceof CoreCommonSchema)
                ) {
                    $configs = array_merge_recursive($configs, $defaultSchema->toConfig());
                }
            }
        }

        return $configs;
    }
}
