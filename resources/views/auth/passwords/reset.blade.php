@extends('layouts.mobile',['page' => __('Verifying your email'), 'pageSlug' => 'reset'])

@section('content')

<div class="container-fluid signin forgot content has-btn-footer has-form">
    <p class="text-center title" style="width: 80%;margin: 0 auto;">
        <span class="text-center d-block">We’ve reset your password and you can enter a new password.</span>
    </p>
    <div class="forgot__content pt-5">
        <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="input-email">{{ __('E-Mail Address') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="input-email" aria-describedby="" required placeholder="linh@gmail.com">
                <span class="separator"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="input-password">{{ __('Password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="input-password" aria-describedby="" required >
                <span class="separator"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="input-password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                <span class="separator"></span>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <button class="btn btn-pixen bg-pixen w-100 mt-4 mb-2" type="submit">{{ __('Reset Password') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
