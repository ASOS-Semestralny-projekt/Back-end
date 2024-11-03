<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Phones',
        ]);

        Category::create([
            'name' => 'Laptops',
        ]);

        Category::create([
            'name' => 'Printers',
        ]);
    }
}