<?php

namespace Akrbdk\News\Database\Factories;

use Akrbdk\News\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Akrbdk\News\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->word();

        return [
            'title' => $title,
            'alias' => Str::slug($title),
            'active' => fake()->boolean
        ];
    }
}
