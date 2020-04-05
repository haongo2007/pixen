@extends('admin.layouts.backend',['page' => __('User'), 'pageSlug' => 'user'])

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detail</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">User</a></li>
                    <li class="breadcrumb-item active">{{ $user->name }}</li>
                </ol>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                        <form class="container-fluid user_detail">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="float-right">
{{--                                        <img src="../assets/images/img1.jpg" class="avatar">--}}
                                        <img src="{{ asset($user->avatarImage()) }}" alt="{{ $user->getName() }}" width="100" height="100" class="img-circle" />
{{--                                        <div class="select-wrap">--}}
{{--                                            @if($user->status == 'offline')--}}
{{--                                                <span class="badge badge-pill badge-danger">Offline</span>--}}
{{--                                            @elseif($user->status == 'online')--}}
{{--                                                <span class="badge badge-pill badge-info">Online</span>--}}
{{--                                            @else--}}
{{--                                                <span class="badge badge-pill badge-dark">Block</span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
                                    </div>

                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="control-label col-md-2">No:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">#{{ $user->id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-7">
                                            <div class="form-group row">
                                                <label class="control-label">Register date:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{ date('d-m-Y', strtotime($user->created_at)) }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">User Name :</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{ $user->getName() }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Password :</label>
                                                <div class="col-md-2">
                                                    <p class="form-control-static">*******</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)" class='reset-link' data-toggle="modal" data-target="#popupchangePassword">Reset password</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{--                                    @if($user->status == 'block')--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group row row-single">--}}
{{--                                                <label class="control-label">Reason Block :</label>--}}
{{--                                                <div class="col-md-6 reason_block">--}}
{{--                                                    {{ $user->reason_block }}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Mail :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Phone :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $user->phone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Country :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">
                                                        @if($user->finished_profile > 0)
                                                        {{ $user->country['name'] }}
                                                        <img class="smallflag" src="{{ asset('storage/'.$user->country['flag_path']) }}" alt="flag" width="25"/>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Birthday :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ date('d-m-Y', strtotime($user->birthday)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @include('admin.user.changepassword', ['userId' => $user->id])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript">
        $('#menu_user').addClass('active');
    </script>
@stop
