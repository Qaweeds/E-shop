<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductUpdateNotification;
use App\Service\ImageService;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{

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
        if ($product->getOriginal('in_stock') <= 0 && $product->in_stock > $product->getOriginal('in_stock')) {
            $product->followers()->get()->each->notify(new ProductUpdateNotification($product));
        }
    }


    public function deleting(Product $product)
    {

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        ImageService::remove($product->thumbnail);
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
