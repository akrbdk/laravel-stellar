<?php

namespace Akrbdk\News\Providers;

use Akrbdk\News\Repositories\CategoryEloquentRepository;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Akrbdk\News\Repositories\ElementEloquentRepository;
use Akrbdk\News\Services\Contracts\BaseService;
use Akrbdk\News\Services\NewsService;
use Akrbdk\News\View\Components\ItemCard\ItemCard;
use Akrbdk\News\View\Components\ItemsList\ItemsList;
use Akrbdk\News\View\Components\RecommendList\RecommendList;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    public const MODULE_VERSION = '1.0.1';

    public const MODULE_NAME = 'news';

    public const PERMISSION = 'package.news.access';

    public array $bindings = [
        CategoryRepository::class => CategoryEloquentRepository::class,
        ElementRepository::class => ElementEloquentRepository::class,
        BaseService::class => NewsService::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'akrbdk-' . self::MODULE_NAME);
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'akrbdk-' . self::MODULE_NAME);
        $this->app->register(NewsOrchidServiceProvider::class);
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
            __DIR__ . '/../../lang' => resource_path('lang/vendor/akrbdk-' . self::MODULE_NAME)
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
        Blade::components([
            ItemCard::class => ItemCard::getAlias(),
            ItemsList::class => ItemsList::getAlias(),
            RecommendList::class => RecommendList::getAlias()
        ]);
    }
}
