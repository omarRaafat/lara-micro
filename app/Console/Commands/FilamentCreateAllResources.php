<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FilamentCreateAllResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:filament-create-all-resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Filament resources for all models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelsPath = app_path('Models');
        $models = File::allFiles($modelsPath);

        foreach ($models as $model) {
            $modelName = pathinfo($model, PATHINFO_FILENAME);
            $resourceName = Str::studly($modelName) . 'Resource';

            $this->call('make:filament-resource', [
                'name' => $resourceName,
                // '--model' => "App\\Models\\$modelName",
            ]);
        }

        $this->info('Filament resources created for all models.');
    }
}
