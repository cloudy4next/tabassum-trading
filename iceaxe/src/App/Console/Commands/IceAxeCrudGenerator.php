<?php

namespace IceAxe\NativeCloud\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class IceAxeCrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IceAxe:crud {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'IceAxe Crud Generator Generates Controller ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        $modelClass = 'App\\Models\\' . $modelName;

        if (!class_exists($modelClass)) {
            $this->error("Model class '$modelClass' not found.");
            exit();
        }
        // Generate Requests
        $requestName = $modelName . 'Request';
        $this->call('make:request', [
            'name' => $requestName,
        ]);

        $this->info("Request Has been created for $requestName");

        // Generate Controller
        $controllerName = $modelName . 'Controller';
        $this->generateCRUD($modelName, $modelClass, $requestName);
        $this->info("CRUD operations for $modelName generated successfully.");

        // Generate Route
        $this->call('IceAxe:routes', [
            '--value' => $controllerName,
        ]);

        // Generate Views;
        $this->generateViews($modelName);

        $this->info("IceAxe Crud operation Completed for $modelName. :)  Enjoy....");

    }

    private function generateCRUD($modelName, $modelClass,$requestName): void
    {
        $this->info("Generating CRUD operations for $modelClass...");

        $columns = Schema::getColumnListing($modelName);

        $this->generateController($modelName, $columns,$requestName);

    }

    private function generateController($modelName, $columns,$requestName): void
    {
        $controllerPath = app_path("Http/Controllers/{$modelName}Controller.php");

        if (File::exists($controllerPath)) {
            $this->error("Controller $modelName already exists!");
            return;
        }

        $stub = $this->getStubContent();
        $stub = str_replace('{{requestName}}', $requestName, $stub);
        $stub = str_replace('{{model}}', $modelName, $stub);
        $stub = str_replace('{{modelLow}}', strtolower($modelName), $stub);
        $stub = str_replace('{{listOperationColumns}}', $this->addColumnsNField($columns, "Column"), $stub);
        $stub = str_replace('{{filtersField}}', $this->addColumnsNField($columns, "Field"), $stub);
        $stub = str_replace('{{createOperationField}}', $this->addColumnsNField($columns, "Field"), $stub);

        File::put($controllerPath, $stub);
    }

    private function addColumnsNField($columnsName, $type): array|string
    {
        $columns = '';
        foreach ($columnsName as $columnName) {
            if ($columnName == 'id') {
                continue;
            }
            $columns .= "\n\t\t\t$type::init('$columnName'),";
        }
        return $columns;
    }

    private function getStubContent(): bool|string
    {
        $stubPath = __DIR__ . '/stubs/controller.stub';
        return file_get_contents($stubPath);
    }

    private function generateViews($modelName)
    {
        $items = ['create', 'edit', 'list'];
        $modelName = strtolower($modelName);
        foreach ($items as $item) {
            $viewDirectory = resource_path("/views/home/{$modelName}");
            $viewPath = "{$viewDirectory}/{$item}.blade.php";
            // Check if the directory exists, and create it if not
            if (!File::isDirectory($viewDirectory)) {
                File::makeDirectory($viewDirectory, 0755, true, true);
            }

            if (File::exists($viewPath)) {
                $this->error("View $modelName/$item already exists!");
                continue;
            }

            $stubPath = __DIR__ . '/stubs/views/' . $item . '.stub';
            $stub = file_get_contents($stubPath);
            $modelName = ucfirst($modelName);
            $stub = str_replace('{{modelName}}', $modelName, $stub);
            $stub = str_replace('{{item}}', $modelName, $stub);
            File::put($viewPath, $stub);

            $this->info("View $modelName/$item created successfully.$viewPath");
        }
    }


}
