<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NewOrderNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Service\Contracts\NewOrderNotificationInterface::class, \App\Service\NewOrderNotificationService::class);
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
