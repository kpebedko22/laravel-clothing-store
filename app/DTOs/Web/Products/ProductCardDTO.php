<?php

namespace App\DTOs\Web\Products;

use Livewire\Wireable;

final class ProductCardDTO implements Wireable
{
    public function __construct(
        protected int    $productId,
        protected string $productSlug,
        protected string $name,
        protected string $desc,
        protected float  $price,
        protected string $firstMediaUrl,
        protected string $categoryPath,
        protected string $categoryName,
        protected bool   $isFavorite,
    ) {
    }

    public function getProductSlug(): string
    {
        return $this->productSlug;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getFirstMediaUrl(): string
    {
        return $this->firstMediaUrl;
    }

    public function getCategoryPath(): string
    {
        return $this->categoryPath;
    }

    public function isFavorite(): bool
    {
        return $this->isFavorite;
    }

    public function setIsFavorite(bool $isFavorite): void
    {
        $this->isFavorite = $isFavorite;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function toLivewire(): array
    {
        return [
            'productId' => $this->productId,
            'productSlug' => $this->productSlug,
            'name' => $this->name,
            'desc' => $this->desc,
            'price' => $this->price,
            'firstMediaUrl' => $this->firstMediaUrl,
            'categoryPath' => $this->categoryPath,
            'categoryName' => $this->categoryName,
            'isFavorite' => $this->isFavorite,
        ];
    }

    public static function fromLivewire($value): ProductCardDTO
    {
        return new ProductCardDTO(
            $value['productId'],
            $value['productSlug'],
            $value['name'],
            $value['desc'],
            $value['price'],
            $value['firstMediaUrl'],
            $value['categoryPath'],
            $value['categoryName'],
            $value['isFavorite'],
        );
    }
}
