<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Region;

class RegionRepository
{
    public function cityPicker(string $search = ''): array
    {
        if ($search) {
            $regions = Region::query()
                ->withWhereHas('cities', function ($q) use ($search) {
                    $q->where('cities.name', 'like', "%$search%")
                        ->select(['id', 'region_id', 'name', 'alias']);
                })
                ->get(['id', 'name']);

            return $regions
                ->map(function (Region $region) {
                    return [
                        'name' => $region->name,
                        'cities' => $region->cities->pluck('name', 'alias'),
                    ];
                })
                ->toArray();
        }

        $cities = City::query()
            ->limit(10)
            ->pluck('name', 'alias');

        return [
            [
                'name' => 'Популярные города',
                'cities' => $cities,
            ],
        ];
    }
}
