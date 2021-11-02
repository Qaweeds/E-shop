@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-12 justify-content-center">
            <div class="col-md-6">
                <div class="row justify-content-around">
                    <h4>{{__('Order')}} #{{$order->id}}</h4>
                    <h5>{{$order->created_at}}</h5>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('Product')}}</th>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('Price')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td><a href="{{route('product.show', $product->id)}}">{{$product->title}}</a></td>
                            <td>{{$product->pivot->quantity}}</td>
                            <td>{{$product->pivot->single_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p><strong>{{__('Total')}}: {{$order->total}}$</strong></p>
                @if($order->CanBeCancelled)
                    <form action="{{route('account.orders.cancel', $order->id)}}" method="post">
                        @csrf @method('put')
                        <button type="submit" class="btn btn-danger">{{__('Cancel')}}</button>
                    </form>
                @endif
            </div>

        </div>
    </div>
@endsection

