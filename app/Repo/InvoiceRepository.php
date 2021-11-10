<?php

namespace App\Repo;

use App\Models\Order;
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
        return Invoice::make()
            ->name('Этот шаблон нужно хорошенько настраивать :)')
            ->buyer($customer)
            ->series(__('Order'))
            ->sequence($order->id)
            ->addItems($items)
            ->notes(__('Thank you for purchase'))
            ->filename(now()->timestamp . '_' . $order->id . '_' . $order->user->surname)
            ->logo(public_path('vendor/invoices/sample-logo.png'));
    }
}
