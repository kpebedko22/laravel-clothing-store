<?php

namespace App\Orders\Sorters;

use Illuminate\Support\Arr;

class SimpleSorter extends Sorter
{
    protected function __construct(
        protected ?string $sortColumn,
        protected ?string $sortDirection
    ) {
    }

    public static function make(?string $sort): static
    {
        $parts = is_string($sort)
            ? explode('_', $sort)
            : [];

        $sortColumn = Arr::get($parts, 0);
        $sortDirection = Arr::get($parts, 1);

        return new static($sortColumn, $sortDirection);
    }

    public function getSortColumn(?string $default = null): ?string
    {
        return $this->sortColumn ?: $default;
    }

    public function getSortDirection(string $default): string
    {
        return in_array($this->sortDirection, ['asc', 'desc'])
            ? $this->sortDirection
            : $default;
    }
}
