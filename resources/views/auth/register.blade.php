@extends('layouts.mobile',['page' => __('Welcome user'), 'pageSlug' => 'register'])

@section('content')
    <!-- start content -->
    <div class="rlt">
        <img src="{{ asset('images/Ellipse1.png') }}" alt="signup" class="absolute-img">
        <button type="button" class="btn-circle absolute-btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <div class="container-fluid signin content has-footer has-form">
        <p class="text-left title">Sign up to join</p>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="register_form" class="needs-validation" novalidate>
            @csrf
            <div class="step_1">
                <div class="form-group">
                    <label for="input-email">{{ __('E-Mail') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" aria-describedby="" placeholder="linh@gmail.com" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <span class="separator"></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="invalid-feedback" role="alert">
                        <strong>Please enter E-Mail</strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="input-password">{{ __('Password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="input-password" aria-describedby="passwordHelp" placeholder="******" required autocomplete="new-password">
                    <span class="separator"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="invalid-feedback" role="alert">
                        <strong>Please enter Password</strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="input-confirmpassword">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control" id="input-confirmpassword" aria-describedby="passwordHelp" placeholder="*****" name="password_confirmation" required autocomplete="new-password">
                    <span class="separator"></span>
                </div>

                <div class="d-flex flex-wrap justify-content-between form-group">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="checkbox-agree" required>
                        <label class="custom-control-label" for="checkbox-agree">I agree to the <b>Terms of Service</b></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-pixen bg-pixen w-100 mt-4 mb-2" type="submit">Sign Up</button>
            </div>
        </form>

    </div>
    <!-- end main content -->

    <!-- button fixed bottom -->

@endsection
{{-- @push('js')
    <script>
        $('body').on('click', '.next', function(event) {
            if ($('.step_2').is(":hidden")) {
                    let flag =[...$('.step_1').find('input')].every(function(val, index) {
                        return $(val).is(':valid');
                    });
                    if ($(this).closest('.footer').prev()[0].checkValidity() === false) {
                        // event.preventDefault();
                        // event.stopPropagation();
                        $(this).closest('.footer').prev().addClass('was-validated');
                    }
                    if(flag){
                        $('.step_1').hide();
                        $('.step_2').show();
                        $('.back').show();
                        $(this).closest('.footer').prev().removeClass('was-validated');
                    }
            }else{
                $('#register_form').submit();
            }
        });
        $('body').on('click', '.back', function(event) {
            $('.step_2').hide();
            $('.step_1').show();
            $(this).hide();
        });
    </script>
@endpush --}}
