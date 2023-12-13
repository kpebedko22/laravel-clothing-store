<?php

namespace App\Listeners\Web;

use App\Events\Web\CityChangedEvent;
use App\Managers\Web\CityAliasCacheManager;
use Illuminate\Support\Facades\Auth;

class CityChangedListener
{
    public function handle(CityChangedEvent $event): void
    {
        $alias = $event->getAlias();

        CityAliasCacheManager::setAlias($alias);

        if (Auth::check()) {
            Auth::user();

            //            $user->update([
            //                'region_id' => RegionRepository::byAliasCached($alias)?->id,
            //            ]);
        }
    }
}
