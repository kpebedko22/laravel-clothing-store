<?php

namespace App\Orders\Sorters;

abstract class Sorter
{
    public abstract function getSortColumn(?string $default = null): ?string;

    public abstract function getSortDirection(string $default): string;
}
