<?php


namespace App\Repo;

use App\Models\OrderStatus;
use App\Models\Product;
use App\Repo\Contracts\OrderRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderRepository implements OrderRepositoryInterface
{

    public function create(Request $request)
    {

        $status_id = OrderStatus::query()->where('name', config('constants.db.order_statuses.in_process'))->value('id');
        $data = $request->all();
        $data['status_id'] = $status_id;
        $data['total'] = Cart::instance('cart')->total();

        $cartItems = Cart::instance('cart')->content()->groupBy('id');

        $order = auth()->user()->orders()->create($data);

        $cartItems->each(function ($item, $productId) use ($order) {
            $product = $item[0];
            $order->products()->attach(
                $product->model,
                [
                    'quantity' => $product->qty,
                    'single_price' => $product->model->price()
                ]
            );
            $item = Product::find($product->id);
            $item->in_stock -= $product->qty;
            $item->save();
        });

        return $order;
    }
}
