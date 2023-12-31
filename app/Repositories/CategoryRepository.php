<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

final class CategoryRepository
{
    public function findByPath(string $path): Category
    {
        return Category::query()
            ->where(['path' => $path])
            ->firstOrFail();
    }

    public function getNavigationCategories(): Collection
    {
        return Category::query()
            ->where(['parent_id' => null])
            ->get();
    }

    public function childCategoriesForCatalog(): Collection
    {
        return Category::query()
            ->with([
                'media',
            ])
            ->where(['parent_id' => null])
            ->get();
    }

    public function childCategories(int $parentId): Collection
    {
        return Category::query()
            ->with([
                'media',
            ])
            ->where(['parent_id' => $parentId])
            ->get();
    }
}
