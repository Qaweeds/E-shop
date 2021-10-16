<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderStoreRequest;
use App\Repo\Contracts\OrderRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request, OrderRepositoryInterface $orderRepository)
    {
        $order = $orderRepository->create($request);
        if (!is_null($order)) {
            Cart::instance('cart')->destroy();
            return redirect()->home()->with(['status' => "Your order '#$order->id' was successfully created"]);
        } else {
            return back()->with(['status' => 'Probably not enough money']);
        }
    }
}
