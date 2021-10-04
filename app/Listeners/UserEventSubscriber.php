<?php

namespace App\Listeners;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEventSubscriber
{

    public static function handleLogin($event)
    {
        Cart::instance('cart')->restore($event->user->instanceCartName());

        $wishes = auth()->user()->wishes()->get();

        if (!empty($wishes)) {
            foreach ($wishes as $product) {
                Cart::instance('wishlist')->add($product->id, $product->title, 1, $product->price())->associate(Product::class);
            }
        }

    }

    public static function handleLogout($event)
    {

        if (Cart::instance('cart')->count()) {
            Cart::instance('cart')->store($event->user->instanceCartName());
        }
    }

}
