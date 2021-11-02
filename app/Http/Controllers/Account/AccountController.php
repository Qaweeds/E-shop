<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('account.edit', ['user' => Auth::user()]);
    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();
        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        auth()->user()->update($data);
        return redirect()->back()->with(['status' => 'Update successful']);
    }

    public function wishlist()
    {
        $wishes = auth()->user()->wishes()->get();

        return view('account.wishlist');
    }

    public function ordersList(){
        $orders = Order::query()->where('user_id', Auth::id())->with('status')->get();

        return view('account.orders.index', compact('orders'));
    }
    public function orderShow(Order $order){
        return view('account.orders.show', compact('order'));
    }

    public function orderCancel(Order $order)
    {
        if($order->CanBeCancelled) {
            if($order->status->name === config('constants.db.order_statuses.paid')) {
                $order->payback();
            }
            $order->update(['status_id' => OrderStatus::query()
                ->where('name', config('constants.db.order_statuses.cancelled'))->value('id')]);

            return redirect()->route('account.orders.list')->with('status', 'Order was cancelled');
        }else{
            return redirect()->route('account.orders.list')->with('warn', 'Order cant be cancelled');
        }
    }
}
