@extends('layouts.app')
@section('content')
    <div class="col-12 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Thank you {{ $order->user->fullname }}!</h3>
                <h4 class="card-subtitle mb-2 text-muted">Currently your order {{$order->status->name}}</h4>
                <h4 class="card-subtitle mb-2 text-muted">Order total: <strong>{{ $order->total }}$</strong></h4>
                <a href="{{ route('account.orders.show', $order) }}"
                   class="btn btn-outline-primary">Order details</a>
            </div>
        </div>
    </div>
@endsection
