<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function findByAliasForManager(?string $alias): City
    {
        $city = $alias
            ? City::query()->firstWhere(['alias' => $alias])
            : City::first();

        return $city ?: City::first();
    }
}
