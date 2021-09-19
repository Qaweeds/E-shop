<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    /* orders or the product*/
    public $orders;

    /**
     * Handle the Product "created" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }


    public function deleting(Product $product)
    {
        Cache::put('deleted_product_orders', $product->orders);

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $orders = Cache::get('deleted_product_orders');

        foreach ($orders as & $order) {
            $order->total = 0;
            $order->products->map(function ($product) use ($order) {
                $order->total += $product->pivot->quantity * $product->pivot->single_price;
            });
            $order->save();
        }
        
        Cache::forget('deleted_product_orders');
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {

    }
}
