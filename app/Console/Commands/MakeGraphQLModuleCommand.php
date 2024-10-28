<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

class MakeGraphQLModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make:graphql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create GraphQL module from boilerplate';

    protected array $container = [];

    public function handle(): bool
    {
        $this->container['name'] = ucwords($this->ask('Please enter the name of the Module'));

        if (strlen($this->container['name']) == 0) {
            $this->error("\nModule name cannot be empty.");
        } else {
            $toEnable = $this->confirm('Do you want to enable this module?', 'yes');

            $this->comment('You have provided the following information:');
            $this->comment('Name:  ' . $this->container['name']);
            $this->comment('Should be enabled: ' . ($toEnable ? 'yes' : 'no'));

            if ($this->confirm('Do you wish to continue?', 'yes')) {
                $this->comment('Success!');
                $this->generate();

                $this->call('module:enable', [
                    'module' => $this->container['name'],
                ]);

            } else {
                return false;
            }

            return true;
        }

        $this->info('Starter ' . $this->container['name'] . ' module installed successfully.');

        return true;
    }

    protected function generate(): void
    {
        $module = $this->container['name'];
        // Model is deprecated for graphql stubs
        $model = $this->container['model'] ?? '';
        $Module = $module;
        $module = strtolower($module);
        $Model = $model;
        $targetPath = base_path('Modules/' . $Module);

        //copy folders
        $this->copy(base_path('stubs/base-graphql-module'), $targetPath);

        //replace contents
        $this->replaceInFile($targetPath . '/config/config.php');
        $this->replaceInFile($targetPath . '/Providers/ModuleServiceProvider.php');
        $this->replaceInFile($targetPath . '/database/seeders/ModuleModuleSeeder.php');
        $this->replaceInFile($targetPath . '/GraphQL/Schemas/ModuleBackOfficeSchema.php');
        $this->replaceInFile($targetPath . '/GraphQL/Schemas/ModuleDefaultSchema.php');
        $this->replaceInFile($targetPath . '/GraphQL/Schemas/Common/ModuleCommonSchema.php');
        $this->replaceInFile($targetPath . '/composer.json');
        $this->replaceInFile($targetPath . '/module.json');
        $this->replaceInFile($targetPath . '/readme.md');

        //rename
        $this->rename($targetPath . '/Providers/ModuleServiceProvider.php', $targetPath . '/Providers/' . $Module . 'ServiceProvider.php');
        $this->rename($targetPath . '/database/seeders/ModuleModuleSeeder.php', $targetPath . '/database/seeders/' . $Module . 'ModuleSeeder.php');
        $this->rename($targetPath . '/GraphQL/Schemas/ModuleBackOfficeSchema.php', $targetPath . '/GraphQL/Schemas/' . $Module . 'BackOfficeSchema.php');
        $this->rename($targetPath . '/GraphQL/Schemas/ModuleDefaultSchema.php', $targetPath . '/GraphQL/Schemas/' . $Module . 'DefaultSchema.php');
        $this->rename($targetPath . '/GraphQL/Schemas/Common/ModuleCommonSchema.php', $targetPath . '/GraphQL/Schemas/Common/' . $Module . 'CommonSchema.php');
    }

    protected function rename($path, $target, $type = null): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            if ($type == 'migration') {
                $timestamp = date('Y_m_d_his_');
                $target = str_replace("create", $timestamp . "create", $target);
                $filesystem->rename($path, $target, true);
                $this->replaceInFile($target);
            } else {
                $filesystem->rename($path, $target, true);
            }
        }
    }

    protected function copy($path, $target): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            $filesystem->mirror($path, $target);
        }
    }

    protected function replaceInFile($path): void
    {
        $name = $this->container['name'];
        // Model is deprecated for graphql stubs
        $model = $this->container['model'] ?? '';
        $types = [
            '{module_}' => null,
            '{module-}' => null,
            '{Module}' => $name,
            '{module}' => strtolower($name),
            '{Model}' => $model,
            '{model}' => strtolower($model),
            '{table}' => Str::snake(Str::pluralStudly($model)),
        ];

        foreach ($types as $key => $value) {
            if (file_exists($path)) {

                if ($key == "module_") {
                    $parts = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    $parts = array_map('strtolower', $parts);
                    $value = implode('_', $parts);
                }

                if ($key == 'module-') {
                    $parts = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    $parts = array_map('strtolower', $parts);
                    $value = implode('-', $parts);
                }

                file_put_contents($path, str_replace($key, $value, file_get_contents($path)));
            }
        }
    }
}
