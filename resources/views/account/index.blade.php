@extends('layouts.app')


@section('content')
    <div class="container">
        <h3 class="text-center">{{__("Personal account")}}</h3>
        <div class="telegram-block">
            @empty($user->telegram_id)
                <h6>{{__(('Add Telegram'))}}</h6>
                <script async
                        src="https://telegram.org/js/telegram-widget.js?15"
                        data-telegram-login="{{ config('services.telegram-bot-api.name') }}"
                        data-size="large"
                        data-radius="0"
                        data-auth-url="{{ route('account.telegram.add') }}"
                        data-request-access="write"
                ></script>
            @endempty
        </div>
        <div class="col-md-12">
            <p>Name: {{$user->name}}</p>
            <p>Surname: {{$user->surname}}</p>
            <p>Email: {{$user->email}}</p>
            <p>birthdate: {{$user->birthdate}}</p>
            <p>Balance: {{$user->balance}}</p>
            <p>Date of register: {{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</p>
        </div>
        <div class="col-md-8">
            <a href="{{route('account.edit')}}" class="btn btn-outline-primary">Edit</a>
            <hr>
            <a href="{{route('account.orders.index')}}" class="btn btn-outline-dark">{{__('Orders')}}</a>
        </div>

    </div>

@endsection
