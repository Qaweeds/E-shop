@component('mail::message')

    Admin Template
    <h1>Новый заказ</h1>
    <p>От: </p> {{$order->user->full_name}}
    <p>На сумму: </p> {{$order->total}}
    <p>Тел: </p> {{$order->user->phone}}
    @component('mail::button', ['url' => 'admin/orders/' . $order->id])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
