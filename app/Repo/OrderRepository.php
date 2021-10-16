<?php


namespace App\Repo;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Repo\Contracts\OrderRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderRepository implements OrderRepositoryInterface
{

    public function create(Request $request)
    {
        $order = null;
        $user = auth()->user();
        $cartTotal = (float)Cart::instance('cart')->total;
        $status_id = OrderStatus::query()->where('name', config('constants.db.order_statuses.in_process'))->value('id');
        $data = $request->all();
        $data['status_id'] = $status_id;
        $data['total'] = $cartTotal;

        if ($user->balance > $cartTotal) {
            try {

                DB::beginTransaction();

                $order = $user->orders()->create($data);
                $this->addProductToOrder($order);
                $user->update(['balance' => $user->balance - $cartTotal]);

                DB::commit();

            } catch
            (\Exception $exception) {
                DB::rollBack();
            }
        }
        return $order;
    }

    private function addProductToOrder(Order $order)
    {
        Cart::instance('cart')->content()->groupBy('id')->each(function ($item) use ($order) {
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
    }
}
