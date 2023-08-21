<?php

namespace Akrbdk\News\Providers;

use Illuminate\Support\ServiceProvider;
use function Laravel\Prompts\select;

class NewsServiceProvider extends ServiceProvider
{
    public const MODULE_VERSION = '1.0.1';

    public const MODULE_NAME = 'news';

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'akrbdk-' . self::MODULE_NAME);
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'akrbdk-' . self::MODULE_NAME);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerViews();
        $this->registerMigrations();
        $this->registerConfig();

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->registerComponents();

        $this->publishes([
            __DIR__ . '/../../lang' => resource_path('akrbdk-' . self::MODULE_NAME)
        ]);
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'akrbdk-' . self::MODULE_NAME);

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/akrbdk-' . self::MODULE_NAME)
        ]);
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations')
        ], 'migrations');
    }

    private function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('akrbdk-' . self::MODULE_NAME . '.php')
        ]);
    }

    private function registerComponents(): void
    {
        //
    }
}
