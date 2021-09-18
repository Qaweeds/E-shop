@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{__('All Categories')}}</h3>
            </div>
            <div class="col-md-6">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-self-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Category</th>
                                        <th class="text-center" scope="col">Products Count</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="text-center"><a href="{{route('category.show', $category->id)}}">{{$category->name}}</a></td>
                                            <td class="text-center"> {{$category->products_count }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
