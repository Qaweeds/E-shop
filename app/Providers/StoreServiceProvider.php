<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Service\Contracts\StoreServiceInterface::class, \App\Service\AWSservice::class);
    }
}
