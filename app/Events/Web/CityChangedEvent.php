<?php

namespace App\Events\Web;

use Illuminate\Foundation\Events\Dispatchable;

class CityChangedEvent
{
    use Dispatchable;

    public function __construct(protected string $alias)
    {
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}
