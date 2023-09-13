<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AuthenticationService;
use App\Services\Interfaces\AuthenticationServiceInterface;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
