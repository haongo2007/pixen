@extends('admin.layouts.backend',['page' => __('User'), 'pageSlug' => 'user'])

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">User</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                        @if(session()->has('flash_message'))
                            <div class="alert alert-success">
                                {{ session()->get('flash_message') }}
                            </div>
                        @endif
                        <table class="table" id="datatables">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Avatar</th>
                                <th>Mail</th>
                                <th>Phone</th>
                                <th>Birthday</th>
                                <th>Country</th>
                                <th>Register date</th>
                                <th>State</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <b>{{ $user->getName() }}</b>
                                    </td>
                                    <td>
                                        <img src="{{ asset($user->avatarImage()) }}" alt="{{ $user->name }}" width="60" height="60" class="img-circle" />
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ ($user->finished_profile > 0) ? '(+'.$user->country['calling_codes'].') '.$user->phone : '' }}
                                        <img src="{{ asset('storage/'.$user->country['flag_path']) }}" alt="{{ $user->country['name'] }}" width="25"/>
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($user->birthday)) }}
                                    </td>
                                    <td>
                                        {{ $user->country['name'] }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($user->created_at)) }}
                                    </td>
                                    <td>
                                        @if($user->isOnline() && $user->id == $user->isOnline())
                                            <span class="badge badge-pill badge-success">Online</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Offline</span>
                                        @endif
                                    </td>
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
                url: "{!! route('admin.user') !!}",
                type: 'GET',
                },
                columns: [
                    { data: 'id' },
                    { data: 'avatar','searchable': false,'sortable':false},
                    { data: 'username','sortable':false},
                    { data: 'email','sortable':false},
                    { data: 'phone','sortable':false},
                    { data: 'birthday'},
                    { data: 'country','sortable':false},
                    { data: 'created_at','searchable': false,'sortable':false},
                    { data: 'state'},
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
                location.href = window.public_url+'admin/user/detail/'+data.id;
            } );
        });
    </script>
@endpush