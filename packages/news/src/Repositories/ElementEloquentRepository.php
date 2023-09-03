<?php

namespace Akrbdk\News\Repositories;

use Akrbdk\News\Models\Element;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ElementEloquentRepository implements Contracts\ElementRepository
{

    /**
     * @var class-string $model
     */
    private $model = Element::class;

    public function save(Model $model): bool
    {
        return $model->save();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function findByPrimary(int|string $primary): Element
    {
        return $this->model::findOrNew($primary);
    }

    public function findActiveByPrimary(int|string $primary): Element
    {
        return $this->model::query()
            ->whereKey($primary)
            ->where('active', true)
            ->where(function (Builder $query){
                $query->whereNull('active_from')->orWhere('active_from', '<=', now());
            })
            ->where(function (Builder $query){
                $query->whereNull('active_to')->orWhere('active_to', '>=', now());
            })
            ->whereHas('category', static fn($query) => $query->where('active', true)->limit(1))
            ->with([
                'category' => static fn($query) => $query->select('id', 'alias', 'title')
            ])->firstOrNew();
    }

    public function findActiveByAlias(string $alias): Element
    {
        return $this->model::query()
            ->where('alias', $alias)
            ->whereHas('category', static fn($query) => $query->where('active', true)->limit(1))
            ->with([
                'category' => static fn($query) => $query->select('id', 'alias', 'title')
            ])->firstOrNew();
    }

    public function getList(array $categories, int $limit = 0, int $offset = 0): Collection
    {
        $query = $this->model::query()
            ->select([
                'id',
                'category_id',
                'title',
                'alias',
                'sort',
                'preview_image',
                'main_image',
                'publish_date',
                'active_from',
                'active_to',
                'preview_text',
                'body_text'
            ])
            ->where('active', true)
            ->where(function (Builder $query){
                $query->whereNull('active_from')->orWhere('active_from', '<=', now());
            })
            ->where(function (Builder $query){
                $query->whereNull('active_to')->orWhere('active_to', '>=', now());
            })
            ->whereHas('category', static function($query) use($categories){
                $query->select('id')->where('active', true)->limit(1);

                if ($categories){
                    $query->whereIn('id', $categories);
                }
            })
            ->with([
                'category' => static fn($query) => $query->select('id', 'alias', 'title')
            ])
            ->orderByDesc('publish_date')
            ->orderByDesc('id');

        if($limit){
            $query->limit($limit);
        }

        if($offset){
            $query->offset($offset);
        }

        return $query->get();
    }
}
