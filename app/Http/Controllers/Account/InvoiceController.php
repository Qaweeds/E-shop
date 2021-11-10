<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repo\InvoiceRepository;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function __invoke(Order $order)
    {
        $this->authorize('view',$order);
        $invoice = InvoiceRepository::create($order);
        return $invoice->download();
    }
}
