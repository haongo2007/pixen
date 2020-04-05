@extends('layouts.mobile',['page' => __('Welcome back'), 'pageSlug' => 'login'])

@section('content')

<!-- start content -->
<div class="container-fluid signin content has-btn-footer has-form">
    <p class="title">Sign in to continue</p>
    @if (session('error'))
        <p class="title text-danger">{{ session('error') }}</p>
    @endif
        {!! Form::open(['route' => 'login','method' => 'post']) !!}
        @csrf
        <div class="form-group">
            <label for="input-email">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" aria-describedby="emailHelp" autocomplete="off" name="email" value="{{ old('email') }}" required  placeholder="linh@gmail.com" autofocus>
            <span class="separator"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="input-password">{{ __('Password') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" name="password" autocomplete="off" required aria-describedby="passwordHelp" placeholder="******">
            <span class="separator"></span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex flex-wrap justify-content-between form-group">
            <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="checkbox-remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="checkbox-remember">{{ __('Remember Me') }}</label>
            </div>
            @if (Route::has('password.request'))
                <div class="form-group">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                </div>
            @endif
            <button class="btn btn-pixen bg-pixen w-100 mt-4 mb-2" type="submit">Sign In</button>
            <a href="{{ route('auth.google') }}" title="" class="w-100 btn-google">
                <img src="{{ asset('images/icon/icons8-google-18.png') }}">
                <span>Sign in with Google</span>
            </a>

            <a class="w-100" href="{{ route('register') }}"><p class="text-center mt-4 h5">Don't have account?  Sign up!</p> </a> 
        </div>
    {!! Form::close() !!}

    

</div>
<!-- end main content -->
@endsection
