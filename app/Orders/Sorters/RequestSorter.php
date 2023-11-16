<?php

namespace App\Orders\Sorters;

use Illuminate\Http\Request;

class RequestSorter extends Sorter
{
    protected const COLUMN_KEY = 'order_by';

    protected const DIRECTION_KEY = 'sort';

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getSortColumn(?string $default = null): ?string
    {
        $sortColumn = $this->request->input(self::COLUMN_KEY);

        return $sortColumn ?: $default;
    }

    public function getSortDirection(string $default): string
    {
        $sort = $this->request->input(self::DIRECTION_KEY);

        return in_array($sort, ['asc', 'desc'])
            ? $sort
            : $default;
    }
}
