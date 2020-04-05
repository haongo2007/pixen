@extends('admin.layouts.backend',['page' => __('Trip'), 'pageSlug' => 'trip'])

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.trip') }}">Trips</a></li>
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
                                        <img src="{{ asset($trip->hasOneUser->avatarImage()) }}" alt="{{ $trip->hasOneUser->getName() }}" width="100" height="100" class="img-circle" />
                                    </div>

                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="control-label col-md-2">No:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">#{{ $trip->id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-7">
                                            <div class="form-group row">
                                                <label class="control-label">Register date:</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static"> {{ date('d-m-Y', strtotime($trip->created_at)) }} </p>
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
                                                    <p class="form-control-static"> <a href="{{ route('admin.user.detail', ['id' => $trip->user_id]) }}">{{ $trip->user->getName() }}</a> </p>
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
                                                        {{ $trip->hasOne_begin_place->name }}
                                                    </p>
                                                    {!! $trip->get_flag($trip->begin_place) !!}
                                                    <span>{{ $trip->get_country_name($trip->begin_place) }}</span>
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
                                                    <p class="form-control-static">{{ $trip->hasOne_arrival_place->name }}</p>
                                                    {!! $trip->get_flag($trip->arrival_place) !!}
                                                    <span>{{ $trip->get_country_name($trip->arrival_place) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Begin Time :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ \Carbon\Carbon::parse($trip->begin_time)->calendar() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Arrival Time :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ \Carbon\Carbon::parse($trip->arrival_time)->calendar() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Size :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $trip->size }} (kg)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row-single">
                                                <label class="control-label">Description :</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $trip->description }}</p>
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
                                <th>Time</th>
                                <th>contact</th>
                                <th>Size</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trip->requests as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset($item->Avatar_user()) }}" alt="" width="50">
                                    </td>
                                    <td>{{ $item->Name_user() }}</td>
                                    <td>
                                        {{ $item->trip->arrival_time }}
                                    </td>
                                    <td>
                                        {{ $item->User_send_rq->phone }}
                                    </td>
                                    <td>
                                        {{ $item->Package->size  }} (kg)
                                    </td>
                                    <td width="20%">
                                        {{ $item->Package->description }}
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

