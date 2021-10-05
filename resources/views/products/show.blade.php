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
                <p>Price: {{$product->price()}}</p>
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
                            <form action="{{route('cart.add', $product->id)}}" method="post" class="form-inline">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="hidden" name="price_with_discount" value="{{$product->price()}}">
                                    <label for="product-count" class="sr-only">Count: </label>
                                    <input type="number" name="product-count" class="form-control"
                                           id="product-count" min="1" max="{{$product->in_stock}}"
                                           value="1">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Buy</button>
                            </form>
                            <hr>
                            @if($wishlist->isUserFollowed($product))
                                <form action="{{route('wishlist.delete', $product)}}" method="post">
                                    @csrf @method('delete')
                                    <input type="submit" class="btn btn-danger" value="{{__('Remove from Wish List')}}">
                                </form>
                            @else
                                <a href="{{route('wishlist.add', $product)}}" class="btn-success btn">{{__('Add To Wish List')}}</a>
                            @endif
                        </div>
                        <hr>
                        <form action="{{route('rating.add', $product)}}" id="addStar" method="post" class="form-horizontal poststars">
                            @csrf
                            <div class="form-group required">

                                <div class="col-sm-12 stars">
                                    @if((!is_null($product->getUserRatingForCurrentProduct())) ?
                                        $q = $product->getUserRatingForCurrentProduct()->rating : $q = 0)
                                    @endif
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" class="star star-{{$i}}" value="{{$i}}" id="star-{{$i}}" name="star"
                                            {{$q == $i ? 'checked': ''}}>
                                        <label for="star-{{$i}}" class="star star-{{$i}}"></label>
                                    @endfor
                                    @if($product->averageRating())  <p class="mt-3">Average rating: {{round($product->averageRating(), 2)}} </p>
                                    @endif
                                </div>
                            </div>
                        </form>
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
