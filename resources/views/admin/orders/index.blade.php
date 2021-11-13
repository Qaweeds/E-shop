@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('All Categories')}}</h3>
            </div>
            <div class="col-md-6">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-self-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">{{__('Date')}}</th>
                                        <th class="text-center" scope="col">{{__('Status')}}</th>
                                        <th class="text-center" scope="col">{{__('Total')}}</th>
                                        <th class="text-center" scope="col" style="min-width: 250px;">{{__('Invoice')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="text-center"><a href="{{route('admin.orders.show', $order->id)}}">{{$order->id}}</a></td>
                                            <td class="text-center"> {{$order->created_at}}</td>
                                            <td class="text-center"> {{$order->status->name}}</td>
                                            <td class="text-center"> {{$order->total}}</td>
                                            <td class="text-center">
                                                <a href="{{route('admin.orders.show', $order->id)}}" class="btn btn-info">{{__('View')}}</a>
                                                <a href="{{route('admin.orders.invoice.send', $order->id)}}" class="btn btn-outline-dark">{{__('Send')}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 m-auto">
            {{$orders->links()}}
        </div>
    </div>
@endsection
