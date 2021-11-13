<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('user_id', Auth::id())->with('status')->orderByDesc('created_at')->get();

        return view('account.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('account.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if($order->CanBeCancelled) {
            try{
                if($order->status->name === config('constants.db.order_statuses.paid')) {
                    $order->payback();
                }
                $order->update(['status_id' => OrderStatus::query()
                    ->where('name', config('constants.db.order_statuses.cancelled'))->value('id')]);
                return redirect()->route('account.orders.index')->with('status', 'Order was cancelled');
            }catch (\Exception $e){
                return redirect()->route('account.orders.index')->with('warn', $e->getMessage());
            }
        }else{
            return redirect()->route('account.orders.index')->with('warn', 'Order cannot be cancelled');
        }
    }
}
