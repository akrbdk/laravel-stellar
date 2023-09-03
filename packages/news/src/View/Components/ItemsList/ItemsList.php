<?php

namespace Akrbdk\News\View\Components\ItemsList;

use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Akrbdk\News\Services\Contracts\BaseService;
use Akrbdk\News\Services\NewsService;
use Akrbdk\News\View\Contracts\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;

class ItemsList extends BaseComponent
{
    private readonly NewsService $newsService;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->newsService = resolve(BaseService::class);
    }

    public static function getAlias(): string
    {
        return 'akrbdk-news-itemsList';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|null
    {
        $data = $this->getRenderData();

        return isset($data['items']) && $data['items']->isNotEmpty() ? view('akrbdk-news::components.items-list', $data) : null;
    }

    protected function getRenderData(): iterable
    {
        $data = [];

        $data['categories'] = $this->newsService->getAllCategories();
        $categoriesIds = $data['categories']->pluck('id')->toArray();

        $items = resolve(ElementRepository::class)
            ->getList($categoriesIds, config('akrbdk-news.elementsCnt', 3));

        $data['items'] = $this->newsService->prepareElements($items);

        unset($categoriesIds, $items);

        return $data;
    }
}
