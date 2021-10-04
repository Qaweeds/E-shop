<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        auth()->user()->addToWishList($product);

        Cart::instance('wishlist')->add($product->id, $product->title, 1, $product->price())->associate($product);

        return redirect()->back()->with(['status' => "The product {$product->title} was add to wishlist"]);
    }

    public function delete(Request $request, Product $product)
    {
        auth()->user()->removeFromWishList($product);

        if (!empty($request->rowId)) {
            Cart::instance('wishlist')->remove($request->rowId);
        } else {
            $content = Cart::instance('wishlist')->content();
            foreach ($content as $item) {
                if ($item->rowId === $product->id) {
                    Cart::instance('wishlist')->remove($item->rowId);
                }
            }
        }

        return redirect()->back()->with(['status' => "The product {$product->title} was removed from wishlist"]);
    }
}
