<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>window.public_url = `{{ asset('/') }}`</script>
    <title>{{ config('app.name', 'Pixen') }}</title>

    <!-- Scripts -->

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/pages/footable-page.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/js/switchery/dist/switchery.min.css') }}" rel="stylesheet" />

    @stack('custom-css')

    <script src="{{ asset('admin/js/jquery/jquery-3.2.1.min.js') }}"></script>
</head>

<body class="skin-purple fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Pixen admin</p>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        Admin
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ (Auth::user()->image) ? asset('storage/' . Auth::user()->image->path) : asset('admin/images/default_user_icon.png') }}" alt="user" class="">
                                <span class="hidden-md-down">{{ Auth::user()->name }} &nbsp;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li  @if ($pageSlug == 'home') class="active " @endif>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="icon-speedometer"></i>
                                <span class="hide-menu">Dashboard </span>
                            </a>
                        </li>
                        <li  @if ($pageSlug == 'user') class="active " @endif>
                            <a href="{{ route('admin.user') }}" id="menu_user">
                                <i class="fas fa-users"></i>
                                <span class="hide-menu">Users </span>
                            </a>
                        </li>
                        <li  @if ($pageSlug == 'trip') class="active " @endif>
                            <a href="{{ route('admin.trip') }}" id="menu_trip">
                                <i class="fas fa-plane"></i>
                                <span class="hide-menu">Trips </span>
                            </a>
                        </li>
                        <li  @if ($pageSlug == 'package') class="active " @endif>
                            <a href="{{ route('admin.package') }}" id="menu_package">
                                <i class="fas fa-suitcase-rolling"></i>
                                <span class="hide-menu">Packages </span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false" id="logout-confirm">
                                <i class="fas fa-sign-out-alt"></i><span class="hide-menu">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

        <!-- footer -->
        <!-- ============================================================== -->
{{--        <footer class="footer">--}}
{{--            © 2019 Nail--}}
{{--        </footer>--}}
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('admin/js/popper/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('admin/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('admin/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('admin/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('admin/js/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('admin/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <!-- jQuery peity -->
    <script src="{{ asset('admin/js/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('admin/js/peity/jquery.peity.init.js') }}"></script>

    <script src="{{ asset('admin/js/switchery/dist/switchery.min.js') }}"></script>

    <!-- Sweet-Alert  -->
    <script src="{{ asset('admin/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $("#logout-confirm").click(function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to logout.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        window.location = `{{ route('admin.logout') }}`;
                    }
                })
            });
        });

    </script>
    <!-- datatable  -->
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    @stack('css')
    @stack('js')
</body>
</html>
