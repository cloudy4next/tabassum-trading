<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->serviceBinding();
    }

    protected function serviceBinding(): void
    {
        $services = [];

        foreach ($services as $serv) {
            $this->app->bind("App\\Contracts\\{$serv}ServiceInterface", "App\\Services\\{$serv}Service");
        }
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
