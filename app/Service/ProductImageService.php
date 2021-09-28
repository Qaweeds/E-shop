<?php


namespace App\Service;


use App\Models\Product;
use App\Models\ProductImage;

class ProductImageService
{
    public static function addImagesToProduct(Product $product, array $images)
    {
        foreach ($images as $image) {
            ProductImage::query()->create(['product_id' => $product->id, 'path' => $image]);
        }
    }
}
