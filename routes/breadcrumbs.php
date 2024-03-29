<?php

use App\Models\Category;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Главная
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('web.index'));
});

// Главная > Авторизация
Breadcrumbs::for('auth.index', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Авторизация', route('web.auth.index'));
});

// Главная > Авторизация > Привязка учётной записи
Breadcrumbs::for('auth.oauth', function (BreadcrumbTrail $trail) {
    $trail->parent('auth.index');
    $trail->push('Привязка учётной записи');
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
        $trail->push($ancestor->name, route('web.catalog.category', $ancestor->path));
    }

    $trail->push($category->name, route('web.catalog.category', $category->path));
});

// Главная > Каталог > [Категория] > [Товар]
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('category', $product->category);
    $trail->push($product->name, route('web.products.show', $product->slug));
});

// Главная > Избранные товары
Breadcrumbs::for('web.favorite_products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Избранные товары', route('web.favorite_products.index'));
});

// Главная > Личный кабинет
Breadcrumbs::for('web.personal.index', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Личный кабинет', route('web.personal.index'));
});

// Главная > Личный кабинет > Личные данные
Breadcrumbs::for('web.personal.profile', function (BreadcrumbTrail $trail) {
    $trail->parent('web.personal.index');
    $trail->push('Личные данные', route('web.personal.profile'));
});

// Главная > Личный кабинет > Приложения и учётные записи
Breadcrumbs::for('web.personal.social_accounts', function (BreadcrumbTrail $trail) {
    $trail->parent('web.personal.index');
    $trail->push('Приложения и учётные записи', route('web.personal.social_accounts'));
});
