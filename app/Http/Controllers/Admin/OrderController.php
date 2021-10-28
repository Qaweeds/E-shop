<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index()
    {
        $orders = Order::with('status')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $statuses = OrderStatus::all();
        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function statusUpdate(Request $request){
        try {
            $order = Order::query()->findOrFail((int)$request->order_id);
            $order->status_id = $request->order_status_id;
            $order->save();
            return back()->with('status', 'Status was updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Status wasn\'t updated');
        }
    }
}
