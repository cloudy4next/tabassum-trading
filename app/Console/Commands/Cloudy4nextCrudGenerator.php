<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Cloudy4nextCrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudy4next:crud {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cloudy4next Crud Generator Generates Controller ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        $modelClass = 'App\\Models\\' . $modelName;

        if (!class_exists($modelClass)) {
            $this->error("Model class '$modelClass' not found.");
            return;
        }
        $controllerName = $modelName . 'Controller';
        $this->generateCRUD($modelName, $modelClass);
        $this->info("CRUD operations for $modelName generated successfully.");
        $this->comment('Note: Future Request will be introduce Controllers..');

        $this->call('cloudy4next:routes', [
            '--value' => $controllerName,
        ]);

    }

    private function generateCRUD($modelName, $modelClass): void
    {
        $this->info("Generating CRUD operations for $modelClass...");

        $columns = Schema::getColumnListing($modelName);

        $this->generateController($modelName,$columns);

    }

    private function generateController($modelName,$columns): void
    {
        $controllerPath = app_path("Http/Controllers/{$modelName}Controller.php");

        if (File::exists($controllerPath)) {
            $this->error("Controller $modelName already exists!");
            return;
        }

        $stub = $this->getStubContent();
        $stub = str_replace('{{model}}', $modelName, $stub);
        $stub = str_replace('{{modelLow}}', strtolower($modelName), $stub);
        $stub = str_replace('{{listOperationColumns}}', $this->addColumnsNField($stub,$columns,"Column"), $stub);
        $stub = str_replace('{{filtersField}}', $this->addColumnsNField($stub,$columns,"Field"), $stub);
        $stub = str_replace('{{createOperationField}}', $this->addColumnsNField($stub,$columns,"Field"), $stub);

        File::put($controllerPath, $stub);
    }

    private function addColumnsNField($stub,$columnsName,$type, ): array|string
    {
        $columns = '';
        foreach ($columnsName as $columnName) {
            $columns .= "\n\t\t\t$type::init('$columnName'),";
        }
        return $columns;
    }

    private function getStubContent(): bool|string
    {
        $stubPath = __DIR__ . '/stubs/controller.stub';
        return file_get_contents($stubPath);
    }

}
