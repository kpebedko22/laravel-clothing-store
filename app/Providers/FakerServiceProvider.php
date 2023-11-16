<?php

namespace App\Providers;

use App\Faker\Provider\ru_RU\Clothing;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $locale = app('config')->get('app.faker_locale') ?? 'en_US';

        $abstract = Generator::class . ':' . $locale;

        $this->app->singleton($abstract, function ($app) {
            $faker = Factory::create();
            $faker->addProvider(new Clothing($faker));

            return $faker;
        });
    }

    public function boot(): void
    {
        //
    }
}
