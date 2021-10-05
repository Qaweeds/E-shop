<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RatingProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Service\Contracts\RatingProductServiceInterface::class, \App\Service\RatingProductService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
