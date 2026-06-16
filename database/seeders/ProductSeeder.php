<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ONLY DONORS
        $donors = User::where('role', 'donor')->get();

        $categories = Category::all();

        $products = [
            [
                'name' => 'iPhone 14 Pro',
                'description' => 'Latest Apple iPhone with A16 chip and amazing camera.',
                'category' => 'Electronics',
                'status' => 'active',
            ],
            [
                'name' => 'Nike Running Shoes',
                'description' => 'Comfortable and durable running shoes.',
                'category' => 'Sports',
                'status' => 'active',
            ],
            [
                'name' => 'Wooden Sofa Set',
                'description' => 'Premium quality wooden sofa set for living room.',
                'category' => 'Furniture',
                'status' => 'active',
            ],
            [
                'name' => 'Fashion Jacket',
                'description' => 'Stylish winter jacket for men and women.',
                'category' => 'Clothing',
                'status' => 'active',
            ],
            [
                'name' => 'Laravel Guide Book',
                'description' => 'Complete guide to learn Laravel from beginner to advanced.',
                'category' => 'Books',
                'status' => 'active',
            ],
        ];

        foreach ($products as $index => $item) {

            $category = $categories->where('name', $item['category'])->first();

            // rotate donors (so products distribute among donors)
            $donor = $donors[$index % $donors->count()] ?? null;

            Product::create([
                'user_id' => $donor ? $donor->id : 1,
                'category_id' => $category->id ?? 1,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'images' => json_encode(['default.jpg']),
                'status' => $item['status'],
            ]);
        }
    }
}
