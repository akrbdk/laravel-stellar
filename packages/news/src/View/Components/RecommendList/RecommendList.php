<?php

namespace Akrbdk\News\View\Components\RecommendList;

use Akrbdk\News\Services\NewsService;
use Akrbdk\News\View\Contracts\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class RecommendList extends BaseComponent
{

    private int $primary = 0;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public static function getAlias(): string
    {
        return 'akrbdk-news-recommendList';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|null
    {
        $data = $this->getRenderData();

        return !empty($data['elements']) && $data['elements']->isNotEmpty()
            ? view('akrbdk-news::components.recommend-list', $data) :
            null;
    }

    protected function getRenderData(): iterable
    {
        return [
            'elements' => resolve(NewsService::class)->getRecommendList($this->primary)
        ];
    }
}
