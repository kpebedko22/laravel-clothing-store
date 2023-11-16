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

        $catNames = $this->getCategoryTree();

        $categories = Category::factory()
            ->count(count($catNames))
            ->state(new Sequence(...$catNames))
            ->create()
            ->each(function (Category $category) use (&$allCategories) {

                $subCatNames = $this->getCategoryTree($category->name);

                $category->children()
                    ->saveMany(
                        $categories = Category::factory()
                            ->count(count($subCatNames))
                            ->state(new Sequence(...$subCatNames))
                            ->create()
                    )
                    ->each(function (Category $subCategory) use (&$allCategories, $category) {

                        $subSubCatNames = $this->getCategoryTree($category->name, $subCategory->name);

                        $subCategory->children()->saveMany(
                            $categories = Category::factory()
                                ->count(count($subSubCatNames))
                                ->state(new Sequence(...$subSubCatNames))
                                ->create()
                        );

                        $allCategories->push($categories);
                    });

                $allCategories->push($categories);
            });

        $products = Product::factory()
            ->count(300)
            ->recycle($colors)
            ->recycle($sizes)
            ->recycle($allCategories)
            ->create();

        User::factory(10)->create();
    }

    protected function getCategoryTree(?string $category = null, ?string $subCategory = null): array
    {
        $plainNames = match ($category) {
            'Женщины' => match ($subCategory) {
                'Одежда' => [
                    'Джемперы и кардиганы', 'Водолазки', 'Брюки', 'Платья', 'Джинсы', 'Блузки и рубашки',
                    'Жакеты и пиджаки', 'Толстовки и худи', 'Юбки', 'Футболки и майки',
                    'Спортивная одежда', 'Шорты', 'Комбинезоны',
                ],
                'Верхняя одежда' => [
                    'Куртки', 'Пальто и плащи', 'Пуховики', 'Жилеты',
                ],
                'Нижнее белье' => [
                    'Трусы', 'Топы', 'Носки и колготки',
                ],
                default => [
                    'Одежда', 'Верхняя одежда', 'Нижнее белье',
                ],
            },
            'Мужчины' => match ($subCategory) {
                'Одежда' => [
                    'Брюки', 'Джемперы и кардиганы', 'Водолазки', 'Толстовки', 'Джинсы', 'Футболки и поло',
                    'Рубашки', 'Спортивная одежда', 'Жакеты и пиджаки', 'Жилеты', 'Шорты',
                ],
                'Верхняя одежда' => [
                    'Куртки', 'Пуховики', 'Пальто и плащи',
                ],
                'Нижнее белье' => [
                    'Трусы', 'Носки', 'Майки',
                ],
                default => [
                    'Одежда', 'Верхняя одежда', 'Нижнее белье',
                ],
            },
            'Девочки' => match ($subCategory) {
                'Одежда' => [
                    'Джемперы и кардиганы', 'Водолазки', 'Брюки и легинсы', 'Верхняя одежда',
                    'Толстовки', 'Джинсы', 'Платья', 'Блузки и рубашки', 'Футболки и топы',
                    'Спортивная одежда', 'Домашняя одежда', 'Юбки', 'Жилеты', 'Комбинезоны', 'Шорты',
                ],
                'Верхняя одежда' => [
                    'Куртки', 'Пуховики', 'Пальто', 'Брюки', 'Ветровки',
                ],
                'Нижнее белье' => [
                    'Трусы', 'Носки и колготки', 'Майки и топы',
                ],
                default => [
                    'Верхняя одежда', 'Одежда', 'Нижнее белье',
                ],
            },
            'Мальчики' => match ($subCategory) {
                'Одежда' => [
                    'Брюки', 'Джемперы и кардиганы', 'Водолазки', 'Верхняя одежда', 'Толстовки',
                    'Джинсы', 'Рубашки', 'Футболки и майки', 'Спортивная одежда',
                    'Жилеты', 'Домашняя одежда', 'Шорты',
                ],
                'Верхняя одежда' => [
                    'Куртки', 'Пуховики',
                ],
                'Нижнее белье' => [
                    'Трусы', 'Носки', 'Майки',
                ],
                default => [
                    'Верхняя одежда', 'Одежда', 'Нижнее белье',
                ],
            },
            default => [
                'Женщины', 'Мужчины', 'Девочки', 'Мальчики'
            ],
        };

        return array_map(function (string $name) {
            return ['name' => $name];
        }, $plainNames);
    }
}
