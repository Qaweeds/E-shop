<?php

namespace App\Repo\Contracts;

use App\Models\Order;
use LaravelDaily\Invoices\Invoice;

interface InvoiceRepositoryInterface
{
    public static function create(Order $order): Invoice;
}
