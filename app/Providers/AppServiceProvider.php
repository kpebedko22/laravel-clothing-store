<?php

namespace App\Providers;

use App\Managers\Web\CityManager;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CityManager::class, function () {
            return new CityManager();
        });
    }

    public function boot(): void
    {
        Relation::enforceMorphMap([
            'product' => Product::class,
            'category' => Category::class,
            'user' => User::class,
        ]);
    }
}
