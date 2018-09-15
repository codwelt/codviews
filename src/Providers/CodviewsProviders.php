<?php

namespace Codwelt\codviews\providers;

use Illuminate\Support\ServiceProvider;

class CodviewsProviders extends ServiceProvider
{
    public function boot()
    {
        self::cargaconfiguraciones();
        self::cargasini();
        self::cargaassets();
        self::cargavistas();
        self::cargaseeders();
        self::cargamiddleware();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/codviews.php', 'courier'
        );
    }

    private function cargavistas()
    {
        self::publicar([__DIR__ . '/../Views' => resource_path('views/codviews/'),], 'views-codviews');
    }

    private function cargaseeders()
    {
        self::publicar([__DIR__ . '/../Seeders/' => database_path('/seeds'),], 'seeder-codviews');
    }

    private function cargamiddleware()
    {
        self::publicar([__DIR__ . '/../Middleware/' => app_path('/Http/Middleware/codviews/'),], 'Middleware-codviews');
    }

    private function cargaconfiguraciones()
    {
        self::publicar([__DIR__ . '/../Config/codviews.php' => config_path('codviews.php')], 'public-config');
    }

    private function cargaassets()
    {
        self::publicar([__DIR__ . '/../public' => public_path('codviews'),], 'public-codviews');
    }

    private function publicar($pu)
    {
        $this->publishes($pu);
    }

    private function cargasini()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations/');
        $this->loadRoutesFrom(realpath(__DIR__ . '/../routes.php'));
    }
}