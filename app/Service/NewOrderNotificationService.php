<?php


namespace App\Service;


use App\Mail\NewOrder\AdminNewOrderMail;
use App\Mail\NewOrder\CustomerNewOrderMail;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Service\Contracts\NewOrderNotificationInterface;
use Illuminate\Support\Facades\Mail;

class NewOrderNotificationService implements NewOrderNotificationInterface
{
    public static function send(Order $order)
    {
        $admin = User::where('role_id', Role::where('name', config('constants.db.roles.admin'))->first()->id)->first();

        if (!empty($admin)) Mail::to($admin)->send(new AdminNewOrderMail($order));

        Mail::to($order->user)->send(new CustomerNewOrderMail($order));

        return true;
    }
}
