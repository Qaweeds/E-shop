@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">{{__("Edit your personal account")}}</h3>

            <form action="{{route('account.update')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',
                        $user->name)}}" required
                        @error('name') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{__('Surname') }}</label>
                    <div class="col-md-6">
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{old('surname',
                        $user->surname)}}" required
                        @error('surname')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',
                        $user->email)}}" required
                        @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{__('Birthdate') }}</label>
                    <div class="col-md-6">
                        <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{old
                        ('birthdate',
                        $user->birthdate)}}" required
                        @error('birthdate') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
