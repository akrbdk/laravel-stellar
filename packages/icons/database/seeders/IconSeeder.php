<?php

namespace Akrbdk\Icons\Database\Seeders;

use Akrbdk\Icons\Models\Icon;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Icon::factory()->count(5)->create();
    }
}
