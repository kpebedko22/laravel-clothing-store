<?php

namespace App\DTOs\Web\Products;

use App\Models\Product;

final class ProductCardDTO
{
    public function __construct(
        protected Product $product,
        protected bool    $isFavorite,
    )
    {
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function isFavorite(): bool
    {
        return $this->isFavorite;
    }
}
