<?php

namespace Akrbdk\News\Orchid\Screens;

use Akrbdk\News\Orchid\Layouts\Element\ListLayout;
use Akrbdk\News\Orchid\Layouts\ElementSelection;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ElementListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->name = trans('akrbdk-news::admin.menu.elementsTitle');

        return [
            'list' => resolve(ElementRepository::class)->getAdminListByFilter(ElementSelection::class)
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
            ->route('platform.news.element')
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
            ElementSelection::class,
            ListLayout::class
        ];
    }
}
