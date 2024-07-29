<?php

namespace Akrbdk\News\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryElementEditScreen extends ElementEditScreen
{
    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(trans('akrbdk-news::admin.orchid.back'))
                ->icon('bs.arrow-left-circle')
                ->route('platform.news.categories'),
            Button::make(trans('akrbdk-news::admin.orchid.delete'))
                ->icon('bs.trash')
                ->method('deleteElement')
                ->confirm(trans('akrbdk-news::admin.orchid.deleteConfirm'))
                ->canSee($this->existsElement)
        ];
    }
}
