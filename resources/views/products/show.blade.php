@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__($product->title)}}</h3>
            </div>
        </div>
        <hr>
        <div class="row">
            @if(Storage::has($product->thumbnail))
                <div class="col-md-6">
                    @if($product->thumbnail)
                        <img src="{{Storage::url($product->thumbnail)}}" alt="{{$product->title}}"
                             class="card-img-top"
                             style="display: block; margin: 0 auto">
                    @endif
                </div>
            @endif
            <div class="col-md-6">
                <p>Price: {{$product->price}}</p>
                <p>SKU: {{$product->SKU}}</p>
                <p>In-Stock: {{$product->in_stock}}</p>
                <hr>
                <div>
                    <span>Category: </span>
                    @if(isset($product->category))
                        @include('categories.parts.category_view', ['category' => $product->category] )
                    @endif
                </div>

                @auth
                    @if($product->in_stock)
                        <hr>
                        <div>
                            <p>Add to Cart: </p>
                            <form action="" method="post" class="form-inline">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="hidden" name="price_with_discount">
                                    <label for="product-count" class="sr-only">Count: </label>
                                    <input type="number" name="product-count" class="form-control"
                                           id="product-count" min="1" max="{{$product->in_stock}}"
                                           value="1">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Buy</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>Description: </h4>
                <p>{{$product->description}}</p>
            </div>
        </div>
    </div>
@endsection
