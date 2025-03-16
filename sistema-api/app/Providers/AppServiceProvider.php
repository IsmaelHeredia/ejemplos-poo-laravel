<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\MetodoPagoInterface;
use App\Services\PagoTarjeta;
use App\Services\PagoService;

use App\Services\MetodoEnvioInterface;
use App\Services\EnvioTerrestre;
use App\Services\EnvioService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MetodoPagoInterface::class, PagoTarjeta::class);
        $this->app->singleton(PagoService::class, function ($app) {
            return new PagoService($app->make(MetodoPagoInterface::class));
        });

        $this->app->bind(MetodoEnvioInterface::class, EnvioTerrestre::class);
        $this->app->singleton(EnvioService::class, function ($app) {
            return new EnvioService($app->make(MetodoEnvioInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
