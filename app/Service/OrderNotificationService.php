<?php


namespace App\Service;


use App\Mail\NewOrder\AdminNewOrderMail;
use App\Mail\NewOrder\CustomerNewOrderMail;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Service\Contracts\OrderNotificationInterface;


class OrderNotificationService implements OrderNotificationInterface
{
    public static function newOrder(Order $order)
    {
        $admin = User::where('role_id', Role::where('name', config('constants.db.roles.admin'))->first()->id)->first();

        if (!empty($admin)) {
            $admin->notify(new OrderNotification(new AdminNewOrderMail($order)));
        }

        $order->notify(new OrderNotification(new CustomerNewOrderMail($order)));
    }
    public static function statusUpdate(Order $order)
    {
        $order->notify(new OrderNotification(new OrderStatusUpdateMail($order)));
    }
}
