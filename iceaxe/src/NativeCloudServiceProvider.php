<?php

namespace IceAxe\NativeCloud;

use IceAxe\NativeCloud\App\Contracts\NativeCloudInterface;
use IceAxe\NativeCloud\App\Services\NativeCloudService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class NativeCloudServiceProvider extends ServiceProvider
{
    public function boot()
    {

        Blade::componentNamespace('IceAxe\\NativeCloud\\Views\\Component', 'native-cloud');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'native-cloud');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views', 'native-cloud');
    }

    public function register()
    {
        $this->app->singleton(NativeCloudInterface::class, NativeCloudService::class);
    }
}
