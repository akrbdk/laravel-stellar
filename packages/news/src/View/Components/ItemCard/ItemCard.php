<?php

namespace Akrbdk\News\View\Components\ItemCard;

use Akrbdk\News\View\Contracts\ComponentAlias;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemCard extends Component implements ComponentAlias
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
        return view('akrbdk-news::components.item-card');
    }

    public static function getAlias(): string
    {
        return 'akrbdk-news-itemCard';
    }
}
