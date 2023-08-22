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
 */

class Category extends Model
{
    use HasFactory;

    public const DEFAULT_SORT = 100;
    public const DEFAULT_INT = 0;

    protected $fillable = [
        'title',
        'alias',
        'locale',
        'sort',
        'active'
    ];

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }
}
