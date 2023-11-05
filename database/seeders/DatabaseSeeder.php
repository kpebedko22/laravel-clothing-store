<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $colors = Color::factory()->count(10)->create();
        $sizes = Size::factory()->count(10)->create();

        $allCategories = collect();

        $categories = Category::factory()
            ->count(5)
            ->state(new Sequence(
                ['name' => 'Женщины'],
                ['name' => 'Мужчины'],
                ['name' => 'Девочки'],
                ['name' => 'Мальчики'],
                ['name' => 'Аксессуары'],
            ))
            ->create()
            ->each(function (Category $category) use (&$allCategories) {
                $category->children()
                    ->saveMany(
                        $categories = Category::factory()
                            ->count(rand(1, 3))
                            ->create()
                    )
                    ->each(function (Category $category) use (&$allCategories) {
                        $category->children()->saveMany(
                            $categories = Category::factory()
                                ->count(rand(1, 3))
                                ->create()
                        );

                        $allCategories->push($categories);
                    });

                $allCategories->push($categories);
            });

        $products = Product::factory()
            ->count(100)
            ->recycle($colors)
            ->recycle($sizes)
            ->recycle($allCategories)
            ->create();

        User::factory(10)->create();
    }
}
