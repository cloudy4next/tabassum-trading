<?php

namespace Cloudy4next\NativeCloud;

use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Cloudy4next\NativeCloud\App\Services\NativeCloudService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class NativeCloudServiceProvider extends ServiceProvider
{
    public function boot()
    {

        Blade::componentNamespace('Cloudy4next\\NativeCloud\\Views\\Component', 'native-cloud');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'native-cloud');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views', 'native-cloud');
    }

    public function register()
    {
        $this->app->singleton(NativeCloudInterface::class, NativeCloudService::class);
    }
}
