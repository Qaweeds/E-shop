@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="text-center">{{__('Your Orders')}}</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Total')}}</th>
                <th>{{__('Info')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->status->name}}</td>
                    <td>{{$order->total}}</td>
                    <td><a href="{{route('account.orders.show', $order->id)}}" class="btn btn-info">{{__('Details')}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
