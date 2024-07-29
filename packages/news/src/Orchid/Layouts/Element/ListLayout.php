<?php

namespace Akrbdk\News\Orchid\Layouts\Element;

use Akrbdk\News\Models\Element;
use Illuminate\Support\Facades\Route;
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
        $subCategory = str_contains(Route::current()->getName(), 'category.');
        $route = $subCategory ? 'platform.news.category.element' : 'platform.news.element';

        return [
            TD::make('id', trans('akrbdk-news::admin.fields.id'))
                ->sort()
                ->filter(TD::FILTER_NUMERIC)
                ->defaultHidden(),
            TD::make('title', trans('akrbdk-news::admin.fields.title'))
                ->sort()
                ->render(static function (Element $element) use ($subCategory, $route) {
                    $params = ['element' => $element];

                    if ($subCategory) {
                        $params['category'] = $element->category_id;
                    }

                    return Link::make($element->title)->route($route, $params);
                }),
            TD::make('alias', trans('akrbdk-news::admin.fields.alias'))
                ->sort(),
            TD::make('sort', trans('akrbdk-news::admin.fields.sort'))
                ->sort(),
            TD::make('category_id', trans('akrbdk-news::admin.fields.category'))
                ->render(static fn(Element $element) => $element->category->title ?? '-'),
            TD::make('publish_date', trans('akrbdk-news::admin.fields.publish_date'))
                ->sort(),
            TD::make('active_from', trans('akrbdk-news::admin.fields.active_from'))
                ->sort()
                ->defaultHidden(),
            TD::make('active_to', trans('akrbdk-news::admin.fields.active_to'))
                ->sort()
                ->defaultHidden(),
            TD::make()->render(static function (Element $element) use ($subCategory, $route) {
                $params = ['element' => $element];

                if ($subCategory) {
                    $params['category'] = $element->category_id;
                }

                return Group::make([
                    Link::make()
                        ->icon($element->active ? 'bg.check-circle-fill' : 'bg.dash-circle')
                        ->route($route, $params),
                    Link::make()
                        ->icon('bg.pencil')
                        ->route($route, $params),
                    Button::make()->icon('bs.trash')
                        ->action(
                            route($route, array_merge($params, ['method' => 'deleteElement']))
                        )
                        ->confirm(trans('akrbdk-news::admin.orchid.deleteConfirm'))
                ]);
            }),

            TD::make('created_at', trans('akrbdk-news::admin.fields.created_at'))->defaultHidden(),
            TD::make('updated_at', trans('akrbdk-news::admin.fields.updated_at'))->defaultHidden(),
        ];
    }
}
