<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),

        'title' => $this->faker->sentence(3),
        'description' => $this->faker->paragraph(),

        'type' => $this->faker->randomElement(['sell', 'donate']),
        'price' => $this->faker->randomFloat(2, 100, 5000),

        'condition' => $this->faker->randomElement(['new', 'used']),
        'is_active' => true,

        'image' => 'products/default.png',
    ];
    }
}
