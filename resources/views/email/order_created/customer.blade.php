@component('mail::message')
    {{-- Я Знаю, что тут нужно писать стили инлайн. Но я очень не хочу этого делать :) --}}
    <h1>Здравствуйте, {{$order->user->name}}</h1>
    <p>Ваш заказ №: {{$order->id}}</p>
    <p>На сумму: {{$order->total}}</p>
    <table>
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{$product->pivot->single_price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3>Спасибо за заказ</h3>
    @component('mail::button', ['url' => 'account'])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
