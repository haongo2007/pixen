<!DOCTYPE html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#db5945">
    <title>{{ __('Pixen') }}</title>
    <script>window.public_url = `{{ asset('/') }}`</script>
    <script>window.token = `{{ csrf_token() }}`</script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/all.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/slick.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/jquery.rateyo.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/css') }}/daterangepicker.css">
    <link  rel="stylesheet" href="{{ asset('css') }}/home.css">
    @stack('css')
</head>
<body>
    @include('layouts.navbar')
    <div class="main-wrapper">
    @yield('content')
    </div>

    <script src="{{ asset('vendors') }}/js/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('vendors') }}/js/popper.min.js"></script>
    <script src="{{ asset('vendors') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendors') }}/js/moment.min.js"></script>
    <script src="{{ asset('vendors') }}/js/daterangepicker.js"></script>
    <script src="{{ asset('vendors') }}/js/slick.min.js"></script>
    <script src="{{ asset('vendors') }}/js/jquery.rateyo.min.js"></script>
    <!-- custome script -->
    <script src="{{ asset('js/common.js') }}"></script>
    @yield('scripts')
    @stack('js')
</body>
</html>
