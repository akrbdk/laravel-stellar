<?php

namespace Akrbdk\News\Orchid\Screens;

use Akrbdk\News\Orchid\Layouts\CategorySelection;
use Akrbdk\News\Orchid\Layouts\Element\ListLayout;
use Akrbdk\News\Orchid\Layouts\ElementSelection;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryElementListScreen extends ElementListScreen
{
    private int $categoryId = 0;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->name = trans('akrbdk-news::admin.menu.subCategoriesTitle');
        $this->categoryId = (int)Route::current()->parameter('category');
        $category = resolve(CategoryRepository::class)->findByPrimary($this->categoryId);

        if($category->exists()){
            $this->name = $category->title;
        }

        return [
            'list' => resolve(ElementRepository::class)->getAdminListByCategoryAndFilter($category, ElementSelection::class)
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(trans('akrbdk-news::admin.orchid.add'))
            ->icon('bn.plus-circle')
            ->route('platform.news.category.elements', ['category' => $this->categoryId])
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CategorySelection::class,
            ListLayout::class
        ];
    }
}
