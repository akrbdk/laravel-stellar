<?php

namespace Akrbdk\News\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use function PHPUnit\Framework\returnArgument;

class CategoryFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return trans('akrbdk-news::admin.filters.title');
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return [
            'title'
        ];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        $title = $this->request->get('title');

        if ($title) {
            $builder->where('title', 'like', '%' . $title . '%');
        }

        return $builder;
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Input::make('title')
                ->placeholder(trans('akrbdk-news::admin.filters.searchTitle'))
                ->value($this->request->get('title'))
        ];
    }
}
