<?php

namespace Akrbdk\News\Orchid\Layouts;

use Akrbdk\News\Orchid\Filters\ElementFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class ElementSelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            ElementFilter::class
        ];
    }
}
