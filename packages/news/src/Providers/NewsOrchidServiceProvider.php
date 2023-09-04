<?php

namespace Akrbdk\News\Providers;

use Akrbdk\News\Orchid\Services\Contracts\OrchidService;
use Akrbdk\News\Orchid\Services\NewsOrchidService;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class NewsOrchidServiceProvider extends OrchidServiceProvider
{
    public array $bindings = [
        OrchidService::class => NewsOrchidService::class
    ];

    public function registerMainMenu(): array
    {
        return [
            Menu::make(trans('akrbdk-news::admin.menu.title'))
                ->title(trans('akrbdk-news::admin.menu.title'))
                ->icon('bs.database')
                ->sort(1000)
                ->active(true)
                ->list([
                    Menu::make(trans('akrbdk-news::admin.menu.categoriesTitle'))
                        ->sort(100)
                        ->icon('bg.gear')
                        ->route('platform.news.category.list')
                        ->active([
                            'platform.news.category.list',
                            'platform.news.category.edit'
                        ])
                        ->permission(NewsServiceProvider::PERMISSION),
                    Menu::make(trans('akrbdk-news::admin.menu.elementsTitle'))
                        ->sort(100)
                        ->icon('bg.file')
                        ->route('platform.news.element.list')
                        ->active([
                            'platform.news.element.list',
                            'platform.news.element.edit'
                        ])
                        ->permission(NewsServiceProvider::PERMISSION),
                ])
                ->permission(NewsServiceProvider::PERMISSION)
        ];
    }

    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(trans('akrbdk-news::admin.menu.title'))
                ->addPermission(NewsServiceProvider::PERMISSION, trans('akrbdk-news::admin.permission.access'))
        ];
    }
}
