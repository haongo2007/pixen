@extends('layouts.mobile',['page' => __('Package'), 'pageSlug' => 'package'])

@section('content')

    <!-- start content -->
    <div class="container-fluid content trip package has-btn-footer">
        <svg height="400" width="400" class="circle">
            <circle cx="200" cy="200" r="130" />
        </svg>
        <div class="row title-wrap  no-gutters">
            <div class="col-12">
                <div class="title">My package</div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="waiting-tab" data-toggle="pill" href="#waiting" role="tab" aria-controls="waiting" aria-selected="true">Waiting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="completed-tab" data-toggle="pill" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                    </li>
                </ul>
                <div class="tab-content container-fluid p-0" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="waiting" role="tabpanel" aria-labelledby="waiting-tab">
                        @foreach($package as $key => $value)
                        <a href="{{ route('package.show',['id' => $value->id]) }}" title="info package">
                            <div class="trip__card row no-gutters">
                                <div class="col-5 col-left">
                                    <div class="title">{{ $value->hasOneUser->first_name.' '.$value->hasOneUser->last_name }}</div>
                                    <img src="{{ asset(Auth::user()->avatarImage()) }}" alt="item" height="83" class="w-100 round">
                                </div>
                                <div class="col-7 col-right pb-2">
                                    <div class="title">Package transport info</div>
                                    <div class="sub">{{ $value['name'] }} - <span>{{ $value['size'] }}</span></div>
                                    <div class="location">
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value['begin_place'] }}</div>
                                        </div>
                                        <div class="h-100 w-100 d-flex align-items-center" style="padding-left: 1.5px;">
                                            <img src="{{ asset('images') }}/icon/arrow_down.png">
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value['arrival_place'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-transparent btn-custom-sm btn-disable w-50" data-id="{{ $value->id }}">Disable package</button>
                            </div>
                        </a>
                        @endforeach
                        <a href="{{ route('package.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100 mt-4">Add new package</button></a>

                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        @foreach($package_expired as $key => $value)
                        <a href="{{ route('package.show',['id' => $value->id]) }}" title="info package">
                            <div class="trip__card row no-gutters">
                                <div class="col-5 col-left">
                                    <div class="title">{{ $value->hasOneUser->first_name.' '.$value->hasOneUser->last_name }}</div>
                                    <img src="{{ asset(Auth::user()->avatarImage()) }}" alt="item" height="83" class="w-100 round">
                                </div>
                                <div class="col-7 col-right pb-2">
                                    <div class="title">Package transport info</div>
                                    <div class="sub">{{ $value['name'] }} - <span>{{ $value['size'] }}</span></div>
                                    <div class="location">
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value['begin_place'] }}</div>
                                        </div>
                                        <div class="h-100 w-100 d-flex align-items-center" style="padding-left: 1.5px;">
                                            <img src="{{ asset('images') }}/icon/arrow_down.png">
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value['arrival_place'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        <a href="{{ route('package.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100 mt-4">Add new package</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content -->
    @endsection
@push('js')
    <script type="text/javascript">
        $(function () {
            $('.btn-disable').click(function () {
                let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ route('package.disable') }}",
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id' : id,
                        'disable': 1
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush
