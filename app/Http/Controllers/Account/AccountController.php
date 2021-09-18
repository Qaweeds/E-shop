<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('account.edit', ['user' => Auth::user()]);
    }

    public function update()
    {
        dd(__METHOD__, \request()->all());
    }
}
