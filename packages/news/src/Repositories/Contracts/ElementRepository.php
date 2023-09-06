<?php

namespace Akrbdk\News\Repositories\Contracts;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Models\Element;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ElementRepository extends BaseRepository
{
    public function findByPrimary(int|string $primary): Element;

    public function findActiveByPrimary(int|string $primary): Element;

    public function findActiveByAlias(string $alias): Element;

    public function getList(array $categories, int $limit, int $offset): Collection;

    public function getAdminListByFilter(string $filterClass): LengthAwarePaginator;
    public function getAdminListByCategoryAndFilter(Category $category, string $filterClass): LengthAwarePaginator;
}
