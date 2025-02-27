<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some categories
        Category::create(['name' => 'Tops']);
        Category::create(['name' => 'Bottoms']);
        Category::create(['name' => 'Shoes']);
        Category::create(['name' => 'Accessories']);
    }
}
