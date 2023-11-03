<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $colors = Color::factory()->count(10)->create();
        $sizes = Size::factory()->count(10)->create();
        $categories = Category::factory()->count(10)->create();

        $products = Product::factory()
            ->count(30)
            ->recycle($colors)
            ->recycle($sizes)
            ->recycle($categories)
            ->create();

        User::factory(10)->create();
    }
}
