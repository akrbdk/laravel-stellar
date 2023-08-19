<?php

namespace Akrbdk\Icons\Providers;

use Illuminate\Support\ServiceProvider;

class IconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'akrbdk-icons');
    }

    public function boot(): void
    {
        $this->registerMigrations();
    }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations')
        ], 'migrations');
    }
}
