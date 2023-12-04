<?php

use App\Enums\Catalog\CatalogSort;

return [
    CatalogSort::Popularity->value => 'По популярности',
    CatalogSort::Newest->value => 'По новизне',
    CatalogSort::PriceAsc->value => 'Цена по возрастанию',
    CatalogSort::PriceDesc->value => 'Цена по убыванию',
    CatalogSort::DiscountAsc->value => 'Скидка по возрастанию',
    CatalogSort::DiscountDesc->value => 'Скидка по убыванию',
];
