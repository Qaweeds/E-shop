<?php


namespace App\Service\Contracts;


use App\Models\Product;

interface WishlistServiceInterface
{
    public function isUserFollowed(Product $product);
}
