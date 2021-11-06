<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use pschocke\TelegramLoginWidget\Facades\TelegramLoginWidget;

class TelegramController extends Controller
{

    public function __invoke(Request $request)
    {

        if (!$telegramUser = TelegramLoginWidget::validate($request)) {
            return redirect()->route('account.index')->with(['warn' => 'Telegram didnt add!']);
        }

        auth()->user()->update([
            'telegram_id' => $telegramUser->get('id')
        ]);

        return redirect()->route('account.index')->with(['status' => 'Telegram add successfully!']);
    }
}
