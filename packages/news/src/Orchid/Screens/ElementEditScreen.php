<?php

namespace Akrbdk\News\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ElementEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->name = trans('akrbdk-news::admin.menu.elementsTitle');

        return [];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(trans('akrbdk-news::admin.orchid.back'))
                ->icon('bn.arrow-left')
                ->route('platform.news.element.list'),
            Button::make(trans('akrbdk-news::admin.orchid.delete'))
                ->icon('bn.trash')
                ->method('deleteElement')
                ->confirm(trans('akrbdk-news::admin.orchid.deleteConfirm'))
                //->canSee()
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [];
    }
}
