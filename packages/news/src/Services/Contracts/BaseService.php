<?php

namespace Akrbdk\News\Services\Contracts;

use Akrbdk\News\Models\Element;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Illuminate\Support\Collection;

interface BaseService
{
    public function __construct(
        CategoryRepository $categoryRepository,
        ElementRepository $elementRepository
    );

    public function getAllCategories(): Collection;

    public function getElementsByCategory(int|array $categoryId, int $excludeElementId, int $count): Collection;

    public function getActiveElementByPrimary(int|string $primary): Element;

    public function prepareElements(Collection $elements): Collection;
}
