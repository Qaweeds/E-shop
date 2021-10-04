<?php


namespace App\Service;


use App\Service\Contracts\WishlistServiceInterface;

class WishlistService implements WishlistServiceInterface
{

    public function isUserFollowed($product)
    {
        $followers = $product->followers()->get()->pluck('id');

        return $followers->contains(auth()->id());
    }
}
