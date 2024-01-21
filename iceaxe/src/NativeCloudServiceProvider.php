<?php

namespace IceAxe\NativeCloud;


use IceAxe\NativeCloud\App\Contracts\NativeCloudInterface;
use IceAxe\NativeCloud\App\Services\NativeCloudService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NativeCloudServiceProvider extends ServiceProvider
{
    protected array $commands = [
        \IceAxe\NativeCloud\app\Console\Commands\GenerateRoutes::class,
        \IceAxe\NativeCloud\app\Console\Commands\IceAxeCrudGenerator::class
    ];

    protected $namespace = 'App\Http\Controllers'; // Add this property

    public function boot()
    {
        $this->configureRoutes();
    //    $this->registerTestRoutes();
        Blade::componentNamespace('IceAxe\\NativeCloud\\Views\\Component', 'native-cloud');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'native-cloud');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views', 'native-cloud');
    }

    public function register(): void
    {
        include_once __DIR__.'/macros.php';
        $this->app->singleton(NativeCloudInterface::class, NativeCloudService::class);
        $this->commands($this->commands);
    }

    protected function configureRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace) // Use $this->namespace
            ->group(base_path('routes/web.php'));
    }
//
//    protected function registerTestRoutes(): void
//    {
//        Route::macro('iceaxe', function ($name, $controller) {
//            $crudMethods = [
//                'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
//            ];
//
//            foreach ($crudMethods as $method) {
//                Route::{$method}("/$name/$method", [$controller, $method])->name("$name.$method");
//            }
//        });
//    }

}
