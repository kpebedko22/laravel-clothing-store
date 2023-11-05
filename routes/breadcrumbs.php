<?php

use App\Models\Category;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Главная
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('web.index'));
});

// Главная > Каталог
Breadcrumbs::for('catalog', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Каталог', route('web.catalog.index'));
});

// Главная > Каталог > [Категория]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, Category $category) {

    $trail->parent('catalog');

    foreach ($category->ancestors as $ancestor) {
        $trail->push($ancestor->name,  route('web.catalog.category', $ancestor->path));
    }

    $trail->push($category->name, route('web.catalog.category', $category->path));

//    $trail->parent('catalog');
//    $trail->push($category->name, route('web.catalog.category', $category->path));
});

// Главная > Каталог > [Категория] > [Товар]
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('category', $product->category);
    $trail->push($product->name, route('web.products.show', $product->slug));
});
