<?php

namespace Akrbdk\News\Orchid\Layouts\Category;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class EditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Switcher::make('category.active')
                ->title(trans('akrbdk-news::admin.fields.active'))
                ->sendTrueOrFalse(),
            Input::make('category.sort')
                ->title(trans('akrbdk-news::admin.fields.sort')),
            Input::make('category.title')
                ->title(trans('akrbdk-news::admin.fields.title'))
                ->required(),
            Input::make('category.alias')
                ->title(trans('akrbdk-news::admin.fields.alias')),
            Button::make(trans('akrbdk-news::admin.orchid.save'))
                ->icon('bs.save')
                ->method('saveCategory')
        ];
    }
}
