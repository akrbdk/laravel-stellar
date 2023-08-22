<?php

namespace Akrbdk\News\Database\Factories;

use Akrbdk\News\Models\Element;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Akrbdk\News\Models\Element>
 */
class ElementFactory extends Factory
{
    protected $model = Element::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->realText(40);

        return [
            'title' => $title,
            'alias' => Str::slug($title),
            'active' => fake()->boolean(),
            'publish_date' => fake()->dateTimeThisYear(),
            'preview_text' => fake()->unique()->realText(120),
            'body_text' => fake()->unique()->realText()
        ];
    }
}
