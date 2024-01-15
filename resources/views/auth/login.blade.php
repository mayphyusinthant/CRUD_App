@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style = "text-align: center">
                    <img src="{{ asset('images/logo.png') }}" alt = "logo" >
                    <h3> Log in to your account </h3>
                    <p class = "text-muted"> Welcome Back! </p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class = "form-group">
                        <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>
                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            
                        <div class = "form-group">
                            <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> 

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    
                            <div class="col-12  btn btn-info card-footer" >
                            <button type="submit" class="btn btn-info" style = "color: white;">

                                    {{ __('Sign In') }}
                            </button>
                            </div>
                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
