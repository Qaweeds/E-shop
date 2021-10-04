<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();
        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        auth()->user()->update($data);
        return redirect()->back()->with(['status' => 'Update successful']);
    }

    public function wishlist()
    {
        $wishes = auth()->user()->wishes()->get();

        return view('account.wishlist');
    }
}
