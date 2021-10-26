<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Service\Contracts\OrderNotificationInterface::class, \App\Service\OrderNotificationService::class);
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
