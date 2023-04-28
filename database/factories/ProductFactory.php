<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
    public function definition()
    {
        return [
            'id' => Uuid::uuid(),
            'category_id' => Category::all()->random()->id,
            'status' => 'preorder',
            'type' => Arr::random(['serial', 'credential']),
            'name' => fake()->jobTitle(),
            'photo' => fake()->imageUrl(1024, 768), // password
            'buy_price' => fake()->numberBetween(0, 1000000),
            'sell_price' => fake()->numberBetween(0, 1000000),
            'discount' => fake()->numberBetween(0, 100),
            'reseller_discount' => fake()->numberBetween(0, 100),
            'installation' => fake()->realText(),
            'description' => fake()->realText(),
            'short_description' => fake()->realText(),
            'features' => fake()->realText(),
            'slug' => str_slug(fake()->jobTitle()),
            'created_at' => fake()->dateTimeBetween('-3 years')
        ];
    }
}
