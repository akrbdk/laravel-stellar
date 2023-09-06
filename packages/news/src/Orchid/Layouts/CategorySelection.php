<?php

namespace Akrbdk\News\Orchid\Layouts;

use Akrbdk\News\Orchid\Filters\CategoryFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class CategorySelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            CategoryFilter::class
        ];
    }
}
