@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">{{__('New Product')}}</h3>
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Descripton</label>
                    <input type="text" id="description" name='description' value="{{old('description')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="short_description">Short description</label>
                    <input type="text" id="short_description" name='short_description' value="{{old('short_description')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="SKU">SKU</label>
                    <input type="text" id="SKU" name='SKU' value="{{old('SKU')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" min="1" id="price" name='price' value="{{old('price')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" min="0" id="discount" name='discount' value="{{old('discount')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="in_stock">In Stock</label>
                    <input type="number" min="0" id="in_stock" name='in_stock' value="{{old('in_stock')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection
