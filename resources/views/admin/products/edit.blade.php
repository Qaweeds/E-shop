@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">{{__('Edit '. $product->title)}}</h3>
            <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{old('title', $product->title)}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Descripton</label>
                    <input type="text" id="description" name='description' value="{{old('description', $product->description)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="short_description">Short description</label>
                    <input type="text" id="short_description" name='short_description'
                           value="{{old('short_description', $product->short_description)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="SKU">SKU</label>
                    <input type="text" id="SKU" name='SKU' value="{{old('SKU', $product->SKU)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" min="1" id="price" name='price' value="{{old('price', $product->price)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" min="0" id="discount" name='discount' value="{{old('discount', $product->discount)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="in_stock">In Stock</label>
                    <input type="number" min="0" id="in_stock" name='in_stock' value="{{old('in_stock', $product->in_stock)}}"
                           class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>

                </div>
            </form>
            <div class="mt-2">
                <form action="{{route('admin.products.destroy', $product->id)}}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </div>
        </div>
    </div>

@endsection
