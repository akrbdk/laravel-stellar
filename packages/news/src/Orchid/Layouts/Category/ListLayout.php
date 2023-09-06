<?php

namespace Akrbdk\News\Orchid\Layouts\Category;

use Akrbdk\News\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'list';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', trans('akrbdk-news::admin.fields.id'))
                ->sort()
                ->filter(TD::FILTER_NUMERIC),
            TD::make('title', trans('akrbdk-news::admin.fields.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(static function (Category $category) {
                    return Link::make($category->title)->route('platform.news.element.list', ['category[]' => $category]);
                }),
            TD::make('alias', trans('akrbdk-news::admin.fields.alias'))
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('sort', trans('akrbdk-news::admin.fields.sort'))
                ->sort(),
            TD::make('elements_count', trans('akrbdk-news::admin.fields.elements_count')),
            TD::make()->render(static function (Category $category) {
                return Group::make([
                    Link::make()->icon($category->active ? 'bg.check-circle-fill' : 'bg.dash-circle'),
                    Link::make()->icon('bg.pencil')
                        ->route('platform.news.category.edit', ['category' => $category]),
                    Button::make()->icon('bs.trash')
                        ->action(
                            route('platform.news.category.edit', ['category' => $category, 'method' => 'deleteCategory'])
                        )
                        ->confirm(trans('akrbdk-news::admin.orchid.deleteConfirm'))
                ]);
            }),
            TD::make('created_at', trans('akrbdk-news::admin.fields.created_at'))->defaultHidden(),
            TD::make('updated_at', trans('akrbdk-news::admin.fields.updated_at'))->defaultHidden(),
        ];
    }
}
