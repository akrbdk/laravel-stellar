<?php

declare(strict_types=1);

use Akrbdk\News\Orchid\Screens\CategoryEditScreen;
use Akrbdk\News\Orchid\Screens\CategoryElementEditScreen;
use Akrbdk\News\Orchid\Screens\CategoryElementListScreen;
use Akrbdk\News\Orchid\Screens\CategoryListScreen;
use Akrbdk\News\Orchid\Screens\ElementEditScreen;
use Akrbdk\News\Orchid\Screens\ElementListScreen;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

//Orchid URLs
Route::domain(config('platform.domain'))
    ->prefix(config('platform.prefix'))
    ->middleware(['web', 'platform'])
    ->group(function (){

        //Categories
        Route::screen('news/category/list', CategoryListScreen::class)
            ->name('platform.news.categories')
            ->breadcrumbs(
                static fn(Trail $trail) => $trail
                    ->parent('platform.index')
                    ->push(trans('akrbdk-news::admin.menu.title'))
            );

        Route::screen('news/category/edit/{category?}', CategoryEditScreen::class)
            ->name('platform.news.category')
            ->breadcrumbs(
                static fn(Trail $trail) => $trail
                    ->parent('platform.index')
                    ->push(trans('akrbdk-news::admin.menu.title'))
                    ->push(trans('akrbdk-news::admin.menu.categoriesTitle'))
            );

        //Elements
        Route::screen('news/list', ElementListScreen::class)
            ->name('platform.news.elements')
            ->breadcrumbs(
                static fn(Trail $trail) => $trail
                    ->parent('platform.index')
                    ->push(trans('akrbdk-news::admin.menu.title'))
            );

        Route::screen('news/edit/{element?}', ElementEditScreen::class)
            ->name('platform.news.element')
            ->breadcrumbs(
                static fn(Trail $trail) => $trail
                    ->parent('platform.index')
                    ->push(trans('akrbdk-news::admin.menu.title'))
                    ->push(trans('akrbdk-news::admin.menu.elementsTitle'))
            );

        //SUB Categories
        Route::screen('news/category/{category}/list', CategoryElementListScreen::class)
            ->name('platform.news.category.elements')
            ->breadcrumbs(
                static fn(Trail $trail) => $trail
                    ->parent('platform.index')
                    ->push(trans('akrbdk-news::admin.menu.title'))
            );

        Route::screen('news/category/{category}/edit/{element?}', CategoryElementEditScreen::class)
            ->name('platform.news.category.element')
            ->breadcrumbs(static function(Trail $trail) {
                $categoryId = (int)Route::current()->parameter('category_id', 0);
                $category = resolve(CategoryRepository::class)->findByPrimary($categoryId);

                return $trail
                    ->parent('platform.index')
                    ->push(trans('akrbdk-news::admin.menu.title'))
                    ->push($category->exists ? $category->title : trans('akrbdk-news::admin.menu.categoriesTitle'));
        });
});

Route::get('/news/{alias}', \Akrbdk\News\Http\ElementController::class)
    ->name('news.element');
