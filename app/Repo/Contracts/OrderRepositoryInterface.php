<?php


namespace App\Repo\Contracts;


use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function create(Request $request);
}
