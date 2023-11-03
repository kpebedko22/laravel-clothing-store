<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'desc' => fake()->realText(),
            'price' => rand(10, 99) * 10000,
            'category_id' => Category::factory(),
            'color_id' => Color::factory(),
            'size_id' => Size::factory(),
        ];
    }
}
