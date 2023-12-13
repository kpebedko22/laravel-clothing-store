<?php

namespace App\Orders;

use App\Orders\Sorters\Sorter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class EloquentQueryOrder extends BaseOrder
{
    protected Builder $builder;

    public function apply(Builder $builder, Sorter $sorter): Builder
    {
        $this->builder = $builder;

        $sortColumn = $sorter->getSortColumn($this->defaultSortColumn);
        $sortDirection = $sorter->getSortDirection($this->defaultSortDirection);

        if (is_null($sortColumn)) {
            return $this->builder;
        }

        if (in_array($sortColumn, $this->defaultSorts)) {
            $this->applyDefaultOrderBy($sortColumn, $sortDirection);
        } else {
            $method = Str::camel($sortColumn);

            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], []);
            }
        }

        return $this->builder;
    }

    protected function applyDefaultOrderBy(string $column, string $direction): Builder
    {
        return $this->builder->orderBy($column, $direction);
    }
}
