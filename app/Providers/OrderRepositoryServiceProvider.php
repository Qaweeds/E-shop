<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repo\Contracts\OrderRepositoryInterface::class, \App\Repo\OrderRepository::class);
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
