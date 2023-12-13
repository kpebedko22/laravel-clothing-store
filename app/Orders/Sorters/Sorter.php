<?php

namespace App\Orders\Sorters;

abstract class Sorter
{
    abstract public function getSortColumn(?string $default = null): ?string;

    abstract public function getSortDirection(string $default): string;
}
