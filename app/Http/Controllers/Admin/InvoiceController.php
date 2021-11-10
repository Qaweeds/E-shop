<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\InvoiceNotification;
use App\Repo\InvoiceRepository;

class InvoiceController extends Controller
{
    public function view(Order $order)
    {
        $invoice = InvoiceRepository::create($order);
        return $invoice->stream();
    }

    public function send(Order $order)
    {
        $invoice = InvoiceRepository::create($order);
        $url = $invoice->save()->url();
        $order->notify(new InvoiceNotification($url));
        return back()->with(['status' => 'Invoice send.']);
    }
}
