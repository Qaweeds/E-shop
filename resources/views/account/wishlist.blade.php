@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('Wish List')}}</h3>
            </div>
            <div class="com-md-12">
                @if(Cart::instance('wishlist')->count())
                    <table class="table table-light">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{__('Product')}}</th>
                            <th>{{__('Price')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('account.parts.product_view', Cart::instance('wishlist')->content(), 'row')
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center"{{__('There is no product in your wish list')}}></h3>
                @endif
            </div>
        </div>
    </div>
@endsection
