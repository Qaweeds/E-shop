<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WishListServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Service\Contracts\WishlistServiceInterface::class, \App\Service\WishlistService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('products.show', function ($v) {
            $v->with('wishlist', new \App\Service\WishlistService);
        });
    }
}
