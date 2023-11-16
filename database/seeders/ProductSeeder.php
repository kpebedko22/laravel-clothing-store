<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::whereNotNull('parent_id')->get();

        Product::factory()
            ->count(500)
            ->recycle($colors)
            ->recycle($sizes)
            ->recycle($categories)
            ->create();
    }
}
