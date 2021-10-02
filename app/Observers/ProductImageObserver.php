<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Service\ImageService;

class ProductImageObserver
{
    /**
     * Handle the ProductImage "created" event.
     *
     * @param \App\Models\ProductImage $productImage
     * @return void
     */
    public function created(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the ProductImage "updated" event.
     *
     * @param \App\Models\ProductImage $productImage
     * @return void
     */
    public function updated(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the ProductImage "deleted" event.
     *
     * @param \App\Models\ProductImage $productImage
     * @return void
     */
    public function deleted(ProductImage $productImage)
    {
        ImageService::remove($productImage->path);
    }

    /**
     * Handle the ProductImage "restored" event.
     *
     * @param \App\Models\ProductImage $productImage
     * @return void
     */
    public function restored(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the ProductImage "force deleted" event.
     *
     * @param \App\Models\ProductImage $productImage
     * @return void
     */
    public function forceDeleted(ProductImage $productImage)
    {
        //
    }
}
