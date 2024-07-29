<?php

namespace Akrbdk\News\Orchid\Screens;

use Akrbdk\News\Orchid\Layouts\Category\ListLayout;
use Akrbdk\News\Orchid\Layouts\CategorySelection;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->name = trans('akrbdk-news::admin.menu.categoriesTitle');

        return [
            'list' => resolve(CategoryRepository::class)->getAdminList()
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
                ->route('platform.news.elements')
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
