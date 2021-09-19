@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-12 justify-content-between">
            <div class="col-md-6">
                <div class="row justify-content-around">
                    <h4>{{__('Order')}} #{{$order->id}}</h4>
                    <h5>{{$order->status->name}}</h5>
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
            </div>
            <div class="col-md-6">
                <div class="row flex-column align-items-center">
                    <h4>{{__('Billing Info')}}</h4>
                    <div class="card" style="width: 22rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{__('Name')}}: {{$order->name}}</li>
                            <li class="list-group-item">{{__('Surname')}}: {{$order->surname}}</li>
                            <li class="list-group-item">{{__('Phone')}}: {{$order->phone}}</li>
                            <li class="list-group-item">{{__('Email')}}: {{$order->email}}</li>
                            <li class="list-group-item">{{__('Country')}}: {{$order->country}}</li>
                            <li class="list-group-item">{{__('City')}}: {{$order->city}}</li>
                            <li class="list-group-item">{{__('Address')}}: {{$order->address}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
