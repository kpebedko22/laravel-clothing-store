<?php

namespace App\Managers\Web;

use App\Models\City;

final class CityManager
{
    private City $city;

    public function setCity(City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCity(): City
    {
        return $this->city;
    }
}
