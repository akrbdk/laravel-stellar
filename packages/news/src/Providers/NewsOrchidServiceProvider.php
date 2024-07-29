<?php

namespace Akrbdk\News\Providers;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Orchid\Services\Contracts\OrchidService;
use Akrbdk\News\Orchid\Services\NewsOrchidService;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
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
        $menuList = [];

        $activeElements = [
            'platform.news.elements',
            'platform.news.element'
        ];
        $menuList[] =  Menu::make(trans('akrbdk-news::admin.menu.elementsTitle'))
//            ->title(trans('akrbdk-news::admin.menu.elementsTitle'))
            ->sort(50)
            ->icon('bg.file')
            ->route('platform.news.elements')
            ->active([
                'platform.news.elements',
                'platform.news.element'
            ])
            ->permission(NewsServiceProvider::PERMISSION);

        $activeCategories = [
            'platform.news.categories',
            'platform.news.category'
        ];
        $menuList[] = Menu::make(trans('akrbdk-news::admin.menu.categoriesTitle'))
//            ->title(trans('akrbdk-news::admin.menu.categoriesTitle'))
            ->sort(100)
            ->icon('bg.gear')
            ->route('platform.news.categories')
            ->active([
                'platform.news.categories',
                'platform.news.category'
            ])
            ->permission(NewsServiceProvider::PERMISSION);

        $activeSubCategories = [];
        resolve(CategoryRepository::class)->getAll()->each(static function (Category $category) use(&$menuList, &$activeSubCategories){
            if(empty($activeSubCategories)){
                $menuList[] = Menu::make()
//                    ->title(trans('akrbdk-news::admin.menu.subCategoriesTitle'))
                    ->sort($category->sort + 100)
                    ->permission(NewsServiceProvider::PERMISSION);
            }

            $activeSubCategory = [
                route('platform.news.category.elements', ['category' => $category]) . '*',
                route('platform.news.category.element', ['category' => $category]) . '/*'
            ];
            $activeSubCategories = array_merge($activeSubCategories, $activeSubCategory);

            $menuList[] = Menu::make($category->title)
                ->sort($category->sort + 110)
                ->icon('bg.file')
                ->route(
                    'platform.news.category.elements', ['category' => $category]
                )
                ->active($activeSubCategory)
                ->permission(NewsServiceProvider::PERMISSION);
        });

        return [
            Menu::make(trans('akrbdk-news::admin.menu.title'))
                ->title(trans('akrbdk-news::admin.menu.title'))
                ->icon('bs.database')
                ->sort(100)
                ->active(array_merge($activeElements, $activeCategories, $activeSubCategories))
                ->list($menuList)
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
