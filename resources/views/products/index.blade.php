@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('All Products')}}</h3>
            </div>
            <div class="col-md-12">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            @each('products.parts.product_view', $products, 'product')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                {{$products->links()}}
            </div>
        </div>
    </div>

@endsection
