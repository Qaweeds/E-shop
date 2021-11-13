<?php

namespace App\Repo;

use App\Jobs\NewOrderNotificationJob;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Transaction;
use App\Repo\Contracts\OrderRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function create($request): Order
    {
        $result = DB::transaction(function () use ($request) {
            $total = Cart::instance('cart')->total();
            $user = auth()->user();
            $request['status_id'] = OrderStatus::query()->where('name', config('constants.db.order_statuses.in_process'))->value('id');
            $request['total'] = $total;
            $order = $user->orders()->create($request);
            $this->addProductsToOrder($order);
            NewOrderNotificationJob::dispatch($order);
            return $order;
        });
        return $result;
    }

    public function setTransaction(string $transaction_order_id, Transaction $transaction)
    {
        $order = Order::where('vendor_order_id', $transaction_order_id)->first();
        if ($order) {
            $order->transaction_id = $transaction->id;
            $order->status_id = OrderStatus::query()->where('name', config('constants.db.order_statuses.paid'))->value('id');
            $order->save();
        }
    }

    private function addProductsToOrder(Order $order)
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
            $in_stock = $product->model->in_stock - $product->qty;

            if (!$product->model->update(['in_stock' => $in_stock])) {
                throw new \Exception("Something wrong with product id={$product->id} updating process", 200);
            }
        });
    }
}
