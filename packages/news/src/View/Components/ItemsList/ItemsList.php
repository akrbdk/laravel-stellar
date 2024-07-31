<?php

namespace Akrbdk\News\View\Components\ItemsList;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Models\Element;
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

        return isset($data['categories']) && $data['categories']->isNotEmpty() ? view('akrbdk-news::components.items-list', $data) : null;
    }

    protected function getRenderData(): iterable
    {
        $data = [];

        $categories = $this->newsService->getAllCategories();

        $categories->each(function (Category $category) use (&$data, ) {
            if($category->elements_count){
                $category->elements = $this->newsService->prepareElements($category->elements()->get());
            }
        });
        $data['categories'] = $categories;
        unset($categories);

        return $data;
    }
}
