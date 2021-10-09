<?php


namespace App\Service;


use App\Mail\NewOrder\AdminNewOrderMail;
use App\Mail\NewOrder\CustomerNewOrderMail;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Service\Contracts\NewOrderNotificationInterface;
use Illuminate\Support\Facades\Log;


class NewOrderNotificationService implements NewOrderNotificationInterface
{
    public static function send(Order $order)
    {
        $admin = User::where('role_id', Role::where('name', config('constants.db.roles.admin'))->first()->id)->first();

        if (!empty($admin)) {
            $admin->notify(new NewOrderNotification(new AdminNewOrderMail($order)));
        }

        $order->user->notify(new NewOrderNotification(new CustomerNewOrderMail($order)));
    }
}
