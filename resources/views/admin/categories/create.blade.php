@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">{{__('New Category')}}</h3>
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{old('description')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Descripton</label>
                    <input type="text" id="description" name='description' value="{{old('description')}}"
                           class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection
