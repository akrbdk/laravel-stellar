<?php

namespace Akrbdk\News\Database\Seeders;

use Akrbdk\News\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(rand(2, 5))->hasElements(rand(10, 20))->createQuietly();
    }
}
