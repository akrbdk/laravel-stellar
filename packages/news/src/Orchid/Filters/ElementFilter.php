<?php

namespace Akrbdk\News\Orchid\Filters;

use Akrbdk\News\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class ElementFilter extends Filter
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
            'title',
            'category'
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
        $category = array_filter(array_map('intval', (array)$this->request->get('category')));

        if ($title) {
            $builder->where('title', 'like', '%' . $title . '%');
        }

        if ($category) {
            $builder->whereIn('category_id', $category);
        }


        return $builder;
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     * @throws BindingResolutionException
     */
    public function display(): iterable
    {
        return [
            Input::make('title')
                ->placeholder(trans('akrbdk-news::admin.filters.searchTitle'))
                ->value($this->request->get('title')),
            Relation::make('category')
                ->fromModel(Category::class, 'title')
                ->placeholder(trans('akrbdk-news::admin.filters.searchCategory'))
                ->value($this->request->get('category'))
                ->multiple()
                ->allowEmpty()
        ];
    }
}
