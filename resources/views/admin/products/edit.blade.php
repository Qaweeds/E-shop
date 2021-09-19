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
        <div class="col-md-12">
            <h3 class="text-center">{{__('Edit').' '. $product->title}}</h3>
            <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="category_id">{{__('Category')}}</label>
                    <select type="text" id="category_id" name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">{{__('Title')}}</label>
                    <input type="text" id="title" name="title" value="{{old('title', $product->title)}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">{{__('Description')}}</label>
                    <input type="text" id="description" name='description' value="{{old('description', $product->description)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="short_description">{{__('Short_description')}}</label>
                    <input type="text" id="short_description" name='short_description'
                           value="{{old('short_description', $product->short_description)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="SKU">{{__('SKU')}}</label>
                    <input type="text" id="SKU" name='SKU' value="{{old('SKU', $product->SKU)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="price">{{__('Price')}}</label>
                    <input type="number" min="1" id="price" name='price' step="0.01" value="{{old('price', $product->price)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="discount">{{__('Discount')}}</label>
                    <input type="number" min="0" id="discount" name='discount' value="{{old('discount', $product->discount ?? 0)}}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="in_stock">{{__('In_stock')}}</label>
                    <input type="number" min="0" id="in_stock" name='in_stock' value="{{old('in_stock', $product->in_stock)}}"
                           class="form-control">
                </div>
                <div>
                    <img class="mb-1" style="max-width: 300px; max-height: 200px;" id="thumbnail-preview"/>
                </div>
                <div class="form-group">
                    <label for="thumbnail">{{__('Thumbnail')}}</label>
                    <input type="file" id="thumbnail" name="thumbnail">
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#thumbnail').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#thumbnail-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>

@endsection
