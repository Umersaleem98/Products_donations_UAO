<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Clothing',
            'Books',
            'Accessories',
            'Furniture',
            'Sports',
            'Gifts',
            'Food',
        ];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}