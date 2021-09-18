@extends('layouts.app')


@section('content')
    <div class="container">
        <h3 class="text-center">{{__("Personal account")}}</h3>
        <div class="col-md-12">
            <p>Name: {{$user->name}}</p>
            <p>Surname: {{$user->surname}}</p>
            <p>Email: {{$user->email}}</p>
            <p>birthdate: {{$user->birthdate}}</p>
            <p>Date of register: {{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</p>
        </div>
        <div class="col-md-8">
            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-outline-primary">Edit</a>
        </div>
    </div>
@endsection
