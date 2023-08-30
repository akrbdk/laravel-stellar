<?php

namespace Akrbdk\News\View\Components\ItemsList;

use Akrbdk\News\View\Contracts\ComponentAlias;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemsList extends Component implements ComponentAlias
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('akrbdk-news::components.items-list');
    }

    public static function getAlias(): string
    {
        return 'akrbdk-news-itemsList';
    }
}
