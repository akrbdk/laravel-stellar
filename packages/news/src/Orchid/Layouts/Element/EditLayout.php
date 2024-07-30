<?php

namespace Akrbdk\News\Orchid\Layouts\Element;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Providers\NewsServiceProvider;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
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
        /*
        'preview_image',
        'main_image',
        'publish_date',
        'active_from',
        'active_to',
        'locale',
        'preview_text',
        'body_text'*/


        return [
            Switcher::make('element.active')
                ->title(trans('akrbdk-news::admin.fields.active'))
                ->sendTrueOrFalse(),
            Input::make('element.sort')
                ->title(trans('akrbdk-news::admin.fields.sort')),
            Input::make('element.title')
                ->title(trans('akrbdk-news::admin.fields.title'))
                ->required(),
            Input::make('element.alias')
                ->title(trans('akrbdk-news::admin.fields.alias')),
            Relation::make('element.category_id')
                ->title(trans('akrbdk-news::admin.fields.category'))
                ->fromModel(Category::class, 'title')
                ->value($this->query->get('category_id')),
            DateTimer::make('element.publish_date')
                ->title(trans('akrbdk-news::admin.fields.publish_date'))
                ->min(Carbon::create(1970, 1, 1))
                ->enableTime()
                ->format24hr()
                ->allowInput()
                ->allowEmpty(),
            DateTimer::make('element.active_from')
                ->title(trans('akrbdk-news::admin.fields.active_from'))
                ->min(Carbon::create(1970, 1, 1))
                ->enableTime()
                ->format24hr()
                ->allowInput()
                ->allowEmpty(),
            DateTimer::make('element.active_to')
                ->title(trans('akrbdk-news::admin.fields.active_to'))
                ->min(Carbon::create(1970, 1, 1))
                ->enableTime()
                ->format24hr()
                ->allowInput()
                ->allowEmpty(),
            Quill::make('element.preview_text')
                ->title(trans('akrbdk-news::admin.fields.preview_text')),
            Quill::make('element.body_text')
                ->title(trans('akrbdk-news::admin.fields.body_text')),
            Picture::make('element.preview_image')
                ->title('akrbdk-news::admin.fields.preview_image')
                ->targetId()
                ->groups(NewsServiceProvider::MODULE_NAME),
            Picture::make('element.main_image')
                ->title('akrbdk-news::admin.fields.main_image')
                ->targetId()
                ->groups(NewsServiceProvider::MODULE_NAME),
            Button::make(trans('akrbdk-news::admin.orchid.save'))
                ->class('btn btn-secondary')
                ->icon('bs.save')
                ->method('saveElement')
        ];
    }
}
