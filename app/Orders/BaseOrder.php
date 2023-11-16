<?php

namespace App\Orders;

abstract class BaseOrder
{
    protected array $defaultSorts = [];

    protected ?string $defaultSortColumn = null;

    protected string $defaultSortDirection = 'asc';
}
