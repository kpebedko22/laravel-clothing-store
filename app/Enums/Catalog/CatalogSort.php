<?php

namespace App\Enums\Catalog;

use Illuminate\Support\Collection;
use Livewire\Wireable;

enum CatalogSort: string implements Wireable
{
    case Popularity = 'popularity';
    case Newest = 'newest';
    case PriceAsc = 'price_asc';
    case PriceDesc = 'price_desc';
    case DiscountAsc = 'discount_asc';
    case DiscountDesc = 'discount_desc';

    public static function options(): Collection
    {
        return collect(self::cases())
            ->mapWithKeys(function (CatalogSort $case) {
                return [$case->value => $case->getLabel()];
            });
    }

    public function getLabel(): string
    {
        return __("enums/catalog/catalog-sort.$this->value");
    }

    public function toLivewire(): string
    {
        return $this->value;
    }

    public static function fromLivewire($value): ?CatalogSort
    {
        return CatalogSort::tryFrom($value);
    }
}
