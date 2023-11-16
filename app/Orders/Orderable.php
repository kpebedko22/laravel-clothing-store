<?php

namespace App\Orders;

use App\Orders\Sorters\Sorter;
use Illuminate\Database\Eloquent\Builder;

trait Orderable
{
    public function scopeOrder(Builder $builder, EloquentQueryOrder $order, Sorter $sorter): Builder
    {
        return $order->apply($builder, $sorter);
    }
}
