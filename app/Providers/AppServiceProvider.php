<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Observers\OrderObserver;
use App\Observers\ProductImageObserver;
use App\Observers\ProductObserver;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
        ProductImage::observe(ProductImageObserver::class);

        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
