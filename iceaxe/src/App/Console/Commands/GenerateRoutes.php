<?php

namespace IceAxe\NativeCloud\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IceAxe:routes {--value= : controller name}';
    protected $description = 'Generate routes for a given model.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = $this->option('value');
        $controllerClass = '\\App\\Http\\Controllers\\' . $controller ;

        if (!class_exists($controllerClass)) {
            $this->error("Controller class '$controllerClass' not found.");
            return;
        }
        $controllerClass =  $controllerClass .'::class';

        $controllerSegments = explode('\\', $controllerClass);
        $controllerName = strtolower(str_replace('Controller::class', '', end($controllerSegments)));

        $this->generateRoutes($controllerClass, $controllerName);
        $this->info("Routes for $controllerClass added successfully.");
    }

    private function generateRoutes($controllerClass, $methodName): void
    {
        $this->info("Generating routes for $controllerClass...");
        $routes = "\n\nRoute::iceaxe('$methodName', $controllerClass);\n";



        $webPath = base_path('routes/web.php');
        $webContent = File::get($webPath);

        if (str_contains($webContent, "Route::middleware('auth')->group(function () {")) {
            $webContent = str_replace(
                "Route::middleware('auth')->group(function () {",
                "Route::middleware('auth')->group(function () {\n\n" . $routes,
                $webContent
            );
        } else {
            $webContent .= "\n\nRoute::middleware('auth')->group(function () {\n\n" . $routes . "\n});";
        }
        File::put($webPath, $webContent);

    }
}
