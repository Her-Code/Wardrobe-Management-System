<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClothingItem;
use App\Models\Category;
use App\Models\User;

class ClothingItemSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users
        $users = User::all();

        // Check if there are users in the database, if not, create one
        if ($users->isEmpty()) {
            $users = User::factory(10)->create();
        }

        // Create clothing items and associate them with a random user
        ClothingItem::create([
            'name' => 'Red Shirt',
            'category_id' => Category::where('name', 'Tops')->first()->id,
            'size' => 'M',
            'color' => 'Red',
            'image' => 'images/red.jpg',  // Path to the image
            'user_id' => $users->random()->id, // Assign a random user
        ]);

        ClothingItem::create([
            'name' => 'Blue Jeans',
            'category_id' => Category::where('name', 'Bottoms')->first()->id,
            'size' => 'L',
            'color' => 'Blue',
            'image' => 'images/bluejeans.jpg',  // Path to the image
            'user_id' => $users->random()->id, // Assign a random user
        ]);

        ClothingItem::create([
            'name' => 'Black Sneakers',
            'category_id' => Category::where('name', 'Shoes')->first()->id,
            'size' => '42',
            'color' => 'Black',
            'image' => 'images/blacksneakers.jpg',  // Path to the image
            'user_id' => $users->random()->id, // Assign a random user
        ]);

        ClothingItem::create([
            'name' => 'Leather Belt',
            'category_id' => Category::where('name', 'Accessories')->first()->id,
            'size' => 'One Size',
            'color' => 'Brown',
            'image' => 'images/leatherbelt.jpg',  // Path to the image
            'user_id' => $users->random()->id, // Assign a random user
        ]);
    }
}

//     public function run(): void
//     {

//         ClothingItem::create([
//             'name' => 'Red Shirt',
//             'category_id' => Category::where('name', 'Tops')->first()->id,
//             'size' => 'M',
//             'color' => 'Red',
//             'image' => 'images/red.jpg'  // Path to the image
//         ]);

//         ClothingItem::create([
//             'name' => 'Blue Jeans',
//             'category_id' => Category::where('name', 'Bottoms')->first()->id,
//             'size' => 'L',
//             'color' => 'Blue',
//             'image' => 'images/bluejeans.jpg'  // Path to the image
//         ]);

//         ClothingItem::create([
//             'name' => 'Black Sneakers',
//             'category_id' => Category::where('name', 'Shoes')->first()->id,
//             'size' => '42',
//             'color' => 'Black',
//             'image' => 'images/blacksneakers.jpg'  // Path to the image
//         ]);

//         ClothingItem::create([
//             'name' => 'Leather Belt',
//             'category_id' => Category::where('name', 'Accessories')->first()->id,
//             'size' => 'One Size',
//             'color' => 'Brown',
//             'image' => 'images/leatherbelt.jpg'  // Path to the image
//         ]);
    
//     }
// } 


