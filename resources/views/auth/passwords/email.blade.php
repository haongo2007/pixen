@extends('layouts.mobile',['page' => __('Forgot Password'), 'pageSlug' => 'email'])

@section('content')
<div class="container-fluid signin forgot content has-btn-footer has-form">
    
    @if (session('status'))
        <p class="text-center title" style="width: 80%;margin: 0 auto;">
            <strong class="text-center d-block invalid-feedback">{{ session('status') }}</strong>
        </p>
        <div class="forgot__content">
            <form>
                <div class="form-group">
                    <a href="https://mail.google.com/" title="gmail">
                        <button class="btn btn-pixen bg-pixen w-100 mt-4 mb-2" type="button">{{ __('Check Email') }}</button>
                    </a>
                </div>
            </form>
        </div>
        @else
        <p class="text-center title" style="width: 80%;margin: 0 auto;">
            <span class="text-center d-block">Enter your email and will send you instruction on how to reset it</span>
        </p>
        <div class="forgot__content pt-5">
            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="input-email">{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="input-email" aria-describedby="" required placeholder="linh@gmail.com">
                    <span class="separator"></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button class="btn btn-pixen bg-pixen w-100 mt-4 mb-2" type="submit">{{ __('Send Password') }}</button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection
@push('js')
    <script>
        $('.btn-transparent').click(function(e) {
            parent.history.back();
            return false;
        });
    </script>
@endpush
