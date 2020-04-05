@extends('admin.layouts.backend',['page' => __('Package'), 'pageSlug' => 'package'])

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Packages</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Packages</li>
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
                    <div class="table-responsive">
                        <table class="table" id="datatables">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Requested</th>
                                <th>Status</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($trips as $trip)
                                <tr>
                                    <td>{{ $trip->id }}</td>
                                    <td>
                                    <img src="{{ asset($trip->hasOneUser->avatarImage()) }}" alt="{{ $trip->hasOneUser->getName() }}" width="60" height="60" class="img-circle" />
                                    </td>
                                    <td>
                                        <b>{{ $trip->hasOneUser->getName() }}</b>
                                    </td>
                                    <td>
                                        {{ $trip->hasOne_begin_place->name }}
                                    </td>
                                    <td>
                                        {{ $trip->hasOne_arrival_place->name }}
                                    </td>
                                    <td>
                                        {{ count($trip->requests) }}
                                    </td>
                                    <td>
                                        @if($trip->disable == 1)
                                            <span class="badge badge-pill badge-danger">Disable</span>
                                        @else
                                            <span class="badge badge-pill badge-info">Enable</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($trip->created_at)) }}
                                    </td>
                                    </a>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
<style>
    table tr th,tr td{
        text-align: center;
    }
    table tr{
        cursor: pointer;
    }
</style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                url: "{!! route('admin.package') !!}",
                type: 'GET',
                },
                columns: [
                    { data: 'id' },
                    { data: 'avatar','searchable': false,'sortable':false},
                    { data: 'username','sortable':false},
                    { data: 'from','sortable':false},
                    { data: 'to','sortable':false},
                    { data: 'requested'},
                    { data: 'status','sortable':false},
                    { data: 'created_at','searchable': false,'sortable':false},
                ],
                "lengthMenu": 
                    [5,10, 25, 50],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Trip",
                }
            });
            $('#datatables tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                console.log(data);
                location.href = window.public_url+'admin/package/detail/'+data.id;
            } );
        });
    </script>
@endpush