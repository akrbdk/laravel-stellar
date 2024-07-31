<?php

namespace Akrbdk\News\Models;

use Akrbdk\News\Database\Factories\CategoryFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $user_id
 * @property bool $active
 * @property int $sort
 * @property string $locale
 * @property string $alias
 * @property string $title
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property mixed $elements_count
 */

class Category extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public const DEFAULT_SORT = 100;
    public const DEFAULT_INT = 0;

    /**
     * @var \Illuminate\Support\Collection|mixed
     */
    public mixed $elements;

    protected $fillable = [
        'title',
        'alias',
        'locale',
        'sort',
        'active'
    ];

    protected array $allowedSorts = [
        'title',
        'alias'
    ];

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }
}
