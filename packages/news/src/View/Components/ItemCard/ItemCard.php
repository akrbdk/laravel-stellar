<?php

namespace Akrbdk\News\View\Components\ItemCard;

use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Akrbdk\News\Services\NewsService;
use Akrbdk\News\View\Components\RecommendList\RecommendedListDto;
use Akrbdk\News\View\Contracts\BaseComponent;
use Closure;
use Illuminate\Contracts\View\View;
use Akrbdk\News\Models\Element;
use Illuminate\Support\Facades\Route;

class ItemCard extends BaseComponent
{
    private ?string $alias;
    private ?Element $element;
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
        $data = $this->getRenderData();

        return view('akrbdk-news::components.item-card', $data);
    }

    protected function getRenderData(): iterable
    {
        $this->alias = Route::current()->parameter('alias');
        $this->element = resolve(ElementRepository::class)->findActiveByAlias($this->alias);

        if(empty($this->element)) {
            abort(404);
        }

        $this->element = resolve(NewsService::class)->prepareElement($this->element);

        $recommendListDto = new RecommendedListDto();
        $recommendListDto->primary = $this->element->getKey();

        return [
            'element' => $this->element,
            'recommendListDto' => $recommendListDto
        ];
    }
}
