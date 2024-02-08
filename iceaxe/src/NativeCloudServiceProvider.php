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


    public function boot()
    {
        Blade::componentNamespace('IceAxe\\NativeCloud\\Views\\Component', 'native-cloud');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'native-cloud');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views', 'native-cloud');
    }

    public function register(): void
    {
        include_once __DIR__ . '/macros.php';
        $this->app->singleton(NativeCloudInterface::class, NativeCloudService::class);
        $this->commands($this->commands);
    }


}
