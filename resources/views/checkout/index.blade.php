@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('Checkout')}}</h3>
                @if($errors->any())
                    {{implode('', $errors->all('<div>:message</div>'))}}
                @endif
            </div>
            <div class="col-md-8">
                <form action="{{route('order.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Name')}}</label>
                        <div class="col-md-6">
                            <input id="name" name="name" type="text" class="form-control" value="{{auth()->user()->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{__('Surname')}}</label>
                        <div class="col-md-6">
                            <input id="surname" name="surname" type="text" class="form-control" value="{{auth()->user()->surname}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
                        <div class="col-md-6">
                            <input id="email" name="email" type="email" class="form-control" value="{{auth()->user()->email}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{__('Phone')}}</label>
                        <div class="col-md-6">
                            <input id="phone" name="phone" type="tel" class="form-control" value="{{auth()->user()->phone}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label text-md-right">{{__('Country')}}</label>
                        <div class="col-md-6">
                            <input id="country" name="country" type="text" class="form-control" value="{{old('country')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{__('City')}}</label>
                        <div class="col-md-6">
                            <input id="city" name="city" type="text" class="form-control" value="{{old('city')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{__('Address')}}</label>
                        <div class="col-md-6">
                            <input id="address" name="address" type="text" class="form-control" value="{{old('address')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 text-right">
                            <input type="submit" class="btn btn-success" value="Create Order">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <table class="table table-light">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Cart::instance('cart')->content() as $cartItem)
                        <tr>
                            @if(Storage::has($cartItem->model->thumbnail))
                                <td><img src="{{Storage::url($cartItem->model->thumbnail)}}" alt="{{$cartItem->name}}" style="width: 40px;"></td>
                            @endif
                            <td>
                                <a href="{{route('product.show', $cartItem->id)}}"><strong>{{$cartItem->name}}</strong></a>
                            </td>
                            <td>{{$cartItem->qty}}</td>
                            <td>{{$cartItem->price}}</td>
                            <td>{{$cartItem->subtotal}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <table class="table table-dark">
                    <tr>
                        <td colspan="2"></td>
                        <td>Subtotal</td>
                        <td>{{Cart::subtotal()}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Tax</td>
                        <td>{{Cart::tax()}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Total</td>
                        <td>{{Cart::total()}}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

@endsection
