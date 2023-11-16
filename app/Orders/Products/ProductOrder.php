<?php

namespace App\Orders\Products;

use App\Orders\EloquentQueryOrder;
use Illuminate\Database\Eloquent\Builder;

class ProductOrder extends EloquentQueryOrder
{
    protected ?string $defaultSortColumn = 'popular';

    protected array $defaultSorts = ['price'];

    public function popular(): Builder
    {
        return $this->builder;
    }
}
