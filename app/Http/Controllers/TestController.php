<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repo\InvoiceRepository;
use App\Service\Contracts\StoreServiceInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

    }
}
