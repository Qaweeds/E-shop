@component('mail::message')
    Order Status Template

    <h1>Здравствуйте, {{$order->user->name}}</h1>

    <h3>Статус вашего заказа №{{$order->id}} был изменен на {{$order->status->name}}</h3>

    @component('mail::button', ['url' => 'account'])
        qq
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
