<?php


namespace App\Service\Contracts;


use App\Models\Product;
use App\Models\Rating;

interface RatingProductServiceInterface
{
    public static function calculate(Rating $model, Product $product);
}
