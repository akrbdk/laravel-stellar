<?php

namespace Akrbdk\Icons\Database\Factories;

use Akrbdk\Icons\Models\Icon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Akrbdk\Icons\Models\Icon>
 */
class IconFactory extends Factory
{
    protected $model = Icon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'icon' => $this->faker->word(),
            'description' => $this->faker->word()
        ];
    }
}
