<?php

namespace Akrbdk\Icons\Models;

use Akrbdk\Icons\Database\Factories\IconFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'description'];

    protected static function newFactory(): IconFactory
    {
        return IconFactory::new();
    }
}
