@extends('layouts.mobile',['page' => __('Trips'), 'pageSlug' => 'trips'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content trip has-btn-footer">
        <svg height="400" width="400" class="circle">
            <circle cx="200" cy="200" r="130" />
        </svg>
        <!-- <img src="../../../public/images/round.png" class="img-round"> -->
        <div class="row title-wrap  no-gutters">
            <div class="col-12">
                <div class="title">My trip</div>
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
                        @foreach($tripsWaiting as $trip)
                        <div class="trip__card row no-gutters">
                            <div class="col-12 col-right pt-2 pb-2">
                                <a href="{{ route('trip.show', ['id' => $trip->id]) }}" class="link_trip">
                                    <div class="text-right mb-3">
                                        <div>Arrival date:</div>
                                        <div class="red">{{ date('Y/m/d h:i', strtotime($trip->arrival_time)) }}</div>
                                    </div>
                                    <div class="location">
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $trip->begin_place }}</div>
                                        </div>
                                        <div class="h-100 w-100 p-2 d-flex align-items-start mt-1">
                                            <div class="line"></div>
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $trip->arrival_place }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <button class="btn btn-transparent btn-custom-sm btn-disable w-50" data-id="{{ $trip->id }}">Disable trip</button>
                        </div>
                        @endforeach
                        <a href="{{ route('trip.create') }}" title=""><button class="btn btn-pixen bg-pixen w-100 mt-4">Add new trip</button></a>
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        @foreach($tripsComplete as $trip)
                            <div class="trip__card row no-gutters">
                                <div class="col-12 col-right pt-2 pb-2">
                                    <a href="{{ route('trip.show', ['id' => $trip->id]) }}" class="link_trip">
                                        <div class="text-right mb-3">
                                            <div>Expired date:</div>
                                            <div>{{ date('Y/m/d h:i', strtotime($trip->arrival_time)) }}</div>
                                        </div>
                                        <div class="location">
                                            <div>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <div>{{ $trip->begin_place }}</div>
                                            </div>
                                            <div class="h-100 w-100 p-2 d-flex align-items-center">
                                                <div class="line"></div>
                                            </div>
                                            <div>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <div>{{ $trip->arrival_place }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{ route('trip.create') }}" title=""><button class="btn btn-pixen bg-pixen w-100 mt-4">Add new trip</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        $(function () {
            $('.btn-disable').click(function () {
                let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ route('trip.disable') }}",
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
