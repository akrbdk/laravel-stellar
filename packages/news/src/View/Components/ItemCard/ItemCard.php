<?php

namespace Akrbdk\News\View\Components\ItemCard;

use Akrbdk\News\View\Contracts\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class ItemCard extends BaseComponent
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public static function getAlias(): string
    {
        return 'akrbdk-news-itemCard';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('akrbdk-news::components.item-card');
    }

    protected function getRenderData(): iterable
    {
        // TODO: Implement getRenderData() method.
    }
}
