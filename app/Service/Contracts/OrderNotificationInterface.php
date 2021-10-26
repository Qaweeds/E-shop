<?php


namespace App\Service\Contracts;


use App\Models\Order;

interface OrderNotificationInterface
{
    public static function newOrder(Order $order);
    public static function statusUpdate(Order $order);
}
