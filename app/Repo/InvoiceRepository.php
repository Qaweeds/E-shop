<?php

namespace App\Repo;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repo\Contracts\InvoiceRepositoryInterface;
use LaravelDaily\Invoices\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    public static function create(Order $order): Invoice
    {
        $customer = Invoice::makeParty([
            'name' => $order->user->full_name,
            'phone' => $order->user->phone,
            'address' => $order->full_address,
        ]);
        foreach ($order->products as $product) {
            $items[] = $item = Invoice::makeItem()
                ->title($product->title)
                ->pricePerUnit($product->pivot->single_price)
                ->quantity($product->pivot->quantity);
        }
        $invoice = Invoice::make()
            ->name('Этот шаблон нужно хорошенько настраивать :)')
            ->buyer($customer)
            ->status($order->status->name)
            ->series(__('Order'))
            ->sequence($order->id)
            ->addItems($items)
            ->notes(__('Thank you for purchase'))
            ->filename(now()->timestamp . '_' . $order->id . '_' . $order->user->surname)
            ->logo(public_path('vendor/invoices/sample-logo.png'));
        if ($order->status->id == OrderStatus::query()->where('name', config('constants.db.order_statuses.in_process'))->value('id')) {
            $invoice->payUntilDays('7');
        }else{
            $invoice->pay_until_days = false;
        }
        return $invoice;
    }
}
