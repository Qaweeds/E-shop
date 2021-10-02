<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEventSubscriber
{

    public static function handleLogin($event)
    {
        Cart::instance('cart')->restore($event->user->instanceCartName());

    }

    public static function handleLogout($event)
    {

        if (Cart::instance('cart')->count()) {
            Cart::instance('cart')->store($event->user->instanceCartName());
        }
    }

}
