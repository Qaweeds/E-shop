@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">{{__("Edit your personal account")}}</h3>
            <form action="{{route('account.update')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',
                        $user->name)}}" required
                        @error('name') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="surname">{{__('Surname') }}</label>
                    <div class="col-md-6">
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{old('surname',
                        $user->surname)}}" required
                        @error('surname')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">{{__('Email') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',
                        $user->email)}}" required
                        @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">{{__('Phone') }}</label>
                    <div class="col-md-6">
                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone',
                        $user->phone)}}" required
                        @error('phone') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="birthdate">{{__('Birthdate') }}</label>
                    <div class="col-md-6">
                        <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{old
                        ('birthdate',
                        $user->birthdate)}}" required
                        @error('birthdate') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
