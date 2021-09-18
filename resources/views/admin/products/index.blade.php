@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('All Categories')}}</h3>
            </div>

            <div class="col-md-6">
                <div class="row justify-content-center">
                    <a href="{{route('admin.products.create')}}" class="btn btn-primary">Создать</a>
                </div>
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-self-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Product</th>
                                        <th class="text-center" scope="col">Products Count</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="text-center"><a href="{{route('admin.products.edit', $product->id)
                                            }}">{{$product->title}}</a></td>
                                            <td class="text-center"> {{$product->in_stock}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-8 m-auto">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
