<?php

namespace App\Http\Middleware\Web;

use App\Managers\Web\CityAliasCacheManager;
use App\Managers\Web\CityManager;
use App\Repositories\CityRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $alias = CityAliasCacheManager::getAlias();

        $city = (new CityRepository)->findByAliasForManager($alias);

        app(CityManager::class)->setCity($city);

        return $next($request);
    }
}
