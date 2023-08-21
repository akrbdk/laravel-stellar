<?php

namespace Akrbdk\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const DEFAULT_SORT = 100;
    public const DEFAULT_INT = 0;
}
