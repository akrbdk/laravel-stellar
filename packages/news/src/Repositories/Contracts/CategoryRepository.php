<?php

namespace Akrbdk\News\Repositories\Contracts;

use Akrbdk\News\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CategoryRepository extends BaseRepository
{
    public function findByPrimary(int|string $primary): Category;

    public function getAll(): Collection;

    public function getAdminList(): LengthAwarePaginator;
}
