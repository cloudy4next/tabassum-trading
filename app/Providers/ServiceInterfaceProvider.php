<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceInterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerServices([
            'User',
            'Retail',
            'Permission'
        ]);
    }

    /**
     * Register the specified services.
     *
     * @param array $services
     */
    protected function registerServices(array $services): void
    {
        foreach ($services as $service) {
            $this->bindServiceInterface($service);
        }
    }

    /**
     * Bind the interface to its implementation.
     *
     * @param string $service
     */
    protected function bindServiceInterface(string $service): void
    {
        $interface = "App\\Contracts\\{$service}ServiceInterface";
        $implementation = "App\\Services\\{$service}Service";

        $this->app->bind($interface, $implementation);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
