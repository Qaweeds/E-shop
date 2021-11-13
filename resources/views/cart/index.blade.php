@extends(('layouts.app'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('Cart')}}</h3>
            </div>
            <div class="col-md-12">
                @if(Cart::instance('cart')->count() > 0)
                    <table class="table table-light">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('cart.parts.product_view', Cart::instance('cart')->content(), 'row')
                        </tbody>
                    </table>
                    <table class="table table-dark" style="width: 300px; float: right">
                        <tr>
                            <td colspan="2"></td>
                            <td>{{__('Subtotal')}}</td>
                            <td>{{Cart::subtotal()}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>{{__('Tax')}}</td>
                            <td>{{Cart::tax()}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>{{__('Total')}}</td>
                            <td>{{Cart::total()}}</td>
                        </tr>
                    </table>
            </div>
            <div class="col-md-12 text-right">
                <a href="{{route('checkout')}}" class="btn btn-outline-success">{{__('Proceed to checkout')}}</a>
            </div>
            @else
                <h3 class="text-center">There is no products in cart</h3>
            @endif
            <hr>
        </div>
    </div>
@endsection
