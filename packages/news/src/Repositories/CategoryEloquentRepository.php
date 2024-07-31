<?php

namespace Akrbdk\News\Repositories;

use Akrbdk\News\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryEloquentRepository implements Contracts\CategoryRepository
{

    /**
     * @var class-string $model
     */
    private $model = Category::class;

    public function save(Model $model): bool
    {
        return $model->save();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function findByPrimary(int|string $primary): Category
    {
        return $this->model::findOrNew($primary);
    }

    public function getAll(): Collection
    {
        return $this->model::query()->where('active', true)->orderBy('sort')->withCount('elements')->orderBy('title')->get();
    }

    public function getAdminList(): LengthAwarePaginator
    {
        return $this->model::filters()->defaultSort('sort')->withCount('elements')->paginate();
    }
}
