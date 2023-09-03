<?php

namespace Akrbdk\News\Services;

use Akrbdk\News\Models\Element;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Akrbdk\News\Services\Contracts\BaseService;
use Illuminate\Support\Collection;

class NewsService implements Contracts\BaseService
{

    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly ElementRepository $elementRepository
    ) {
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function getElementsByCategory(int|array $categoryId, int $excludeElementId, int $count): Collection
    {
        $res = $this->elementRepository->getList(is_array($categoryId) ? $categoryId : [$categoryId]);

        return $this->prepareElements($res);
    }

    public function prepareElements(Collection $elements): Collection
    {
        $dateFormat = config('akrbdk-news.dateFormat', 'dd.mm.yyyy');
        $elements->each(function (Element $element) use ($dateFormat){
            $element->publishDateFormat = $element->publish_date?->translatedFormat($dateFormat);
        });

        return $elements;
    }

    public function getActiveElementByPrimary(int|string $primary): Element
    {
        return $this->elementRepository->findActiveByPrimary($primary);
    }
}
