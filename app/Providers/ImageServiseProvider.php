<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageServiseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Service\Contracts\ImageServiseInterface::class, \App\Service\ImageService::class);
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
