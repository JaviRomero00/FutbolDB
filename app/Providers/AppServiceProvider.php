<?php

namespace App\Providers;

use App\Services\FootballService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registramos los servicios en el contenedor.
     *
     * @return void
     */
    public function register()
    {
        // Registrar el FootballService
        $this->app->singleton(FootballService::class, function ($app) {
            return new FootballService();
        });
    }

    public function boot()
    {
        //
    }
}
