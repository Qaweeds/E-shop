<?php


namespace App\Service\Contracts;


use App\Models\Order;

interface NewOrderNotificationInterface
{
    public static function send(Order $order);
}
