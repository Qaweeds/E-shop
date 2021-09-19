@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="col-md-6">
            <h3 class="text-center">{{__('New Product')}}</h3>
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="category_id">{{__('Category')}}</label>
                    <select type="text" id="category_id" name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">{{__('Title')}}</label>
                    <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">{{__('Descripton')}}</label>
                    <textarea rows="10" type="text" id="description" name='description'
                              class="form-control">{{old('description')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="short_description">{{__('Short description')}}</label>
                    <input type="text" id="short_description" name='short_description' value="{{old('short_description')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="SKU">{{__('SKU')}}</label>
                    <input type="text" id="SKU" name='SKU' value="{{old('SKU')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="price">{{__('Price')}}</label>
                    <input type="number" min="1" id="price" name='price' value="{{old('price')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="discount">{{__('Discount')}}</label>
                    <input type="number" min="0" id="discount" name='discount' value="{{old('discount', 0)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="in_stock">{{__('In Stock')}}</label>
                    <input type="number" min="0" id="in_stock" name='in_stock' value="{{old('in_stock')}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="thumbnail">{{__('Thumbnail')}}</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>

                <div class="form-group">
                    <label for="images">{{__('Images')}}</label>
                    <input type="file" id="images" name="images[]" multiple>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection
