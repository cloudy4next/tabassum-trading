<?php

namespace IceAxe\NativeCloud;


use IceAxe\NativeCloud\app\Console\Commands\GenerateRoutes;
use IceAxe\NativeCloud\app\Console\Commands\IceAxeCrudGenerator;
use IceAxe\NativeCloud\App\Contracts\NativeCloudInterface;
use IceAxe\NativeCloud\App\Services\NativeCloudService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class NativeCloudServiceProvider extends ServiceProvider
{
    protected array $commands = [
        GenerateRoutes::class,
        IceAxeCrudGenerator::class
    ];


    public function boot()
    {
        Blade::componentNamespace('IceAxe\\NativeCloud\\Views\\Component', 'native-cloud');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'native-cloud');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views', 'native-cloud');
        $this->publish();
    }

    public function register(): void
    {
        include_once __DIR__ . '/macros.php';
        $this->app->scoped(NativeCloudInterface::class, NativeCloudService::class);
        $this->commands($this->commands);
    }

    public function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views/components/left-sidebar' => resource_path('views/vendor/native-cloud/components/left-sidebar'),
        ], 'iceaxe-views');
    }


}
