
@extends('admin.layouts.login')

@section('content')
    <form class="form-horizontal form-material" id="loginform" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <h3 class="text-center m-b-20">Sign In</h3>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="Email" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" required="" placeholder="Password" name="password">
            </div>
        </div>
        @error('email')
        <div class="form-group">
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        </div>
        @enderror
        <div class="form-group row">
            <div class="col-md-12">
                <div class="d-flex no-block align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                    </div>
{{--                    <div class="ml-auto">--}}
{{--                        <a href="{{ route('password.reset') }}" class="text-muted"><i class="fas fa-lock m-r-5"></i> Forgot pwd?</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <div class="col-xs-12 p-b-20">
                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
            </div>
        </div>
{{--        <div class="form-group m-b-0">--}}
{{--            <div class="col-sm-12 text-center">--}}
{{--                Don't have an account? <a href="{{ route('admin.register') }}" class="text-info m-l-5"><b>Sign Up</b></a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </form>
@endsection
