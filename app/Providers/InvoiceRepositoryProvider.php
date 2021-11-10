<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InvoiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repo\Contracts\InvoiceRepositoryInterface::class, \App\Repo\InvoiceRepository::class);
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
