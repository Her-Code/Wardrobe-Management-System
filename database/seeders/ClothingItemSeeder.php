<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClothingItem;
use App\Models\Category;
use Faker\Factory as Faker;
use App\Models\User;


class ClothingItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // $categories = Category::pluck('name', 'id'); // Get all categories in a simple key-value format
        $categories = Category::pluck('id', 'name')->toArray();
        $user = User::first();

        $clothingItems = [
            [
                'name' => 'Red Shirt',
                'category_name' => 'Tops',
                'size' => 'M',
                'color' => 'Red',
            ],
            [
                'name' => 'Blue Jeans',
                'category_name' => 'Bottoms',
                'size' => 'L',
                'color' => 'Blue',
            ],
            [
                'name' => 'Black Sneakers',
                'category_name' => 'Shoes',
                'size' => '42',
                'color' => 'Black',
            ],
            [
                'name' => 'Leather Belt',
                'category_name' => 'Accessories',
                'size' => 'One Size',
                'color' => 'Brown',
            ],
        ];

        foreach ($clothingItems as $item) {
            // Get category ID based on name
            // $categoryId = Category::where('name', $item['category_name'])->first()->id;
            $categoryId = $categories[$item['category_name']];
            // Generate a random image filename using Faker
            $imagePath = 'images/clothing/' . $faker->word . '.jpg'; // Random image name

            // Create the clothing item
            ClothingItem::create([
                'name' => $item['name'],
                'user_id' => $user->id,
                'category_id' => $categoryId,
                'size' => $item['size'],
                'color' => $item['color'],
                'image' => $imagePath, // Assign the generated random image
            ]);
        }
    }
}


// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\ClothingItem;
// use App\Models\Category;

// class ClothingItemSeeder extends Seeder
// {

    /**
     * Run the database seeds.
     */
//     public function run(): void
//     {

//         ClothingItem::create([
//             'name' => 'Red Shirt',
//             'category_id' => Category::where('name', 'Tops')->first()->id,
//             'size' => 'M',
//             'color' => 'Red',
//             'image' => 'images/clothing/red-shirt.jpg'  // Path to the image
//         ]);

//         ClothingItem::create([
//             'name' => 'Blue Jeans',
//             'category_id' => Category::where('name', 'Bottoms')->first()->id,
//             'size' => 'L',
//             'color' => 'Blue',
//             'image' => 'images/clothing/blue-jeans.jpg'  // Path to the image
//         ]);

//         ClothingItem::create([
//             'name' => 'Black Sneakers',
//             'category_id' => Category::where('name', 'Shoes')->first()->id,
//             'size' => '42',
//             'color' => 'Black',
//             'image' => 'images/clothing/black-sneakers.jpg'  // Path to the image
//         ]);

//         ClothingItem::create([
//             'name' => 'Leather Belt',
//             'category_id' => Category::where('name', 'Accessories')->first()->id,
//             'size' => 'One Size',
//             'color' => 'Brown',
//             'image' => 'images/clothing/leather-belt.jpg'  // Path to the image
//         ]);
    
//     }
// } 


