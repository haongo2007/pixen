@extends('admin.layouts.backend',['page' => __('package'), 'pageSlug' => 'package'])

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.package') }}">packages</a></li>
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
                                        <img src="{{ asset($package->hasOneUser->avatarImage()) }}" alt="{{ $package->hasOneUser->getName() }}" width="100" height="100" class="img-circle" />
                                    </div>

                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="control-label col-md-2">No:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">#{{ $package->id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-7">
                                            <div class="form-group row">
                                                <label class="control-label">Register date:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{ date('d-m-Y', strtotime($package->created_at)) }} </p>
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
                                                    <p class="form-control-static"> <a href="{{ route('admin.user.detail', ['id' => $package->user_id]) }}">{{ $package->hasOneUser->getName() }}</a> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">From :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">
                                                        {{ $package->hasOne_begin_place->name }}
                                                    </p>
                                                    {!! $package->get_flag($package->begin_place) !!}
                                                    <span>{{ $package->get_country_name($package->begin_place) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">To :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $package->hasOne_arrival_place->name }}</p>
                                                    {!! $package->get_flag($package->arrival_place) !!}
                                                    <span>{{ $package->get_country_name($package->arrival_place) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Begin Time :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ \Carbon\Carbon::parse($package->begin_time)->calendar() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Arrival Time :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ \Carbon\Carbon::parse($package->arrival_time)->calendar() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Size :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $package->size }} (kg)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Description :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $package->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4 class="text-themecolor">Requested List</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Receiving Time</th>
                                <th>contact</th>
                                <th>Size</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($package->requests as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset($item->Avatar_user_pickup()) }}" alt="" width="50">
                                    </td>
                                    <td>{{ $item->Name_user_pickup() }}</td>
                                    <td>
                                        {{ $item->Trip->begin_time }}
                                    </td>
                                    <td>
                                        {{ $item->User_pickup_rq->phone }}
                                    </td>
                                    <td>
                                        {{ $item->Trip->size  }} (kg)
                                    </td>
                                    <td width="20%">
                                        {{ $item->Trip->description }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

