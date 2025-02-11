<?php

namespace Akrbdk\News\Models;

use Akrbdk\News\Database\Factories\ElementFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property ?int $category_id
 * @property ?int user_id
 * @property bool $active
 * @property int $sort
 * @property ?int $preview_image
 * @property ?int $main_image
 * @property string $title
 * @property string $alias
 * @property string $preview_text
 * @property string $body_text
 * @property string $locale
 * @property ?Carbon $publish_date
 * @property ?Carbon $active_from
 * @property ?Carbon $active_to
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Element extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public const DEFAULT_SORT = 100;
    public const DEFAULT_INT = 0;
    /**
     * @var mixed|string|null
     */
    public ?string $publishDateFormat = null;
    /**
     * @var mixed|string
     */
    public mixed $url;

    protected $fillable = [
        'title',
        'alias',
        'sort',
        'preview_image',
        'main_image',
        'publish_date',
        'active_from',
        'active_to',
        'locale',
        'preview_text',
        'body_text'
    ];

    protected array $allowedSorts = [
        'title',
        'alias'
    ];

    protected $casts = [
        'publish_date' => 'datetime'
    ];

    protected static function newFactory(): Factory
    {
        return ElementFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
