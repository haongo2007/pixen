@extends('layouts.mobile',['page' => __('Home'), 'pageSlug' => 'status'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content status has-btn-footer">
        <svg height="400" width="400" class="circle">
            <circle cx="200" cy="200" r="130" />
        </svg>
        <!-- <img src="../../../public/images/round.png" class="img-round"> -->
        <div class="row title-wrap  no-gutters">
            <div class="col-12">
                <div class="title">Status</div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="trip-tab" data-toggle="pill" href="#trip" role="tab" aria-controls="trip" aria-selected="true">The trip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="package-tab" data-toggle="pill" href="#package" role="tab" aria-controls="package" aria-selected="false">The package</a>
                    </li>
                </ul>
                <div class="tab-content container-fluid" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="trip" role="tabpanel" aria-labelledby="trip-tab">
                        <select class="form-control mb-3 select-status" id="trip_option">
                            <option value="trip_from_traveler">From the traveler</option>
                            <option value="trip_from_you">From you</option>
                        </select>
                        <div id="trip_from_traveler" class="trip_from">
                            @foreach($requestTraveler as $request)
                            <div class="card" id="trip_request_{{ $request->id }}">
                                <div class="person__card">
                                    <div class="person__card-name">
                                        {{ $request->trip->user->getName() }}
                                    </div>
                                    <div class="person__card-date">
                                        Joined: {{ date('Y/m/d', strtotime($request->trip->user->created_at)) }}
                                    </div>
                                    <img src="{{ ($request->trip->user->avarta) ? asset('storage/' . $request->trip->user->avarta->path) : asset('images/person_real.png') }}" alt="person" class="d-block mt-2 mb-2 ml-auto mr-auto">
                                    <div class="person__card-date">
                                        Online<br>Begin
                                    </div>
                                </div>
                                <div class="card_info">
                                    <div class="col-12 mb-3">
                                        <div class=""><span>Item itinerary: </span> <br> From {{ $request->trip->begin_place }} to {{ $request->trip->arrival_place }}.</div>
                                        <div class=""><span>Description: </span> {{ $request->description }}</div>
                                        <div class=""><span>Item size: </span> {{ $request->item_bought }}</div>
                                        <div class=" font-weight-normal"><span class="red">Estimated deliver time: <br></span> {{ date('Y/m/d h:i', strtotime($request->trip->begin_time)) }} - {{ date('Y/m/d h:i', strtotime($request->trip->arrival_time)) }}</div>
                                        <div class=" font-weight-normal"><span class="red">Reality deliver time: </span> {{ date('Y/m/d') }}</div>
                                    </div>
                                </div>
                                <button class="btn btn-black submit submit-receive" onclick="updateStatus({{ $request->id }}, {{ Config::get('constants.status.sent') }}, 'trip')">Send</button>
                            </div>
                            @endforeach
                        </div>
                        <div id="trip_from_you" style="display: none;" class="trip_from">
                            @foreach($requestTransportFromYou as $request)
                                <div class="card" id="trip_request_{{ $request->id }}">
                                    <div class="person__card">
                                        <div class="person__card-name">
                                            {{ $request->trip->user->getName() }}
                                        </div>
                                        <div class="person__card-date">
                                            Joined: {{ date('Y/m/d', strtotime($request->trip->user->created_at)) }}
                                        </div>
                                        <img src="{{ ($request->trip->user->avarta) ? asset('storage/' . $request->trip->user->avarta->path) : asset('images/person_real.png') }}" alt="person" class="d-block mt-2 mb-2 ml-auto mr-auto">
                                        <div class="person__card-date">
                                            Online<br>Begin
                                        </div>
                                    </div>
                                    <div class="card_info">
                                        <div class="col-12 mb-3">
                                            <div class=""><span>Item itinerary: </span> <br> From {{ $request->trip->begin_place }} to {{ $request->trip->arrival_place }}.</div>
                                            <div class=""><span>Description: </span> {{ $request->description }}</div>
                                            <div class=""><span>Item size: </span> {{ $request->item_bought }}</div>
                                            <div class=" font-weight-normal"><span class="red">Estimated deliver time: <br></span> {{ date('Y/m/d', strtotime($request->trip->begin_time)) }} - {{ date('Y/m/d', strtotime($request->trip->arrival_time)) }}</div>
                                            <div class=" font-weight-normal"><span class="red">Reality deliver time: </span> {{ date('Y/m/d') }}</div>
                                        </div>
                                    </div>
                                    @if($request->status == Config::get('constants.status.sent'))
                                    <button class="btn btn-black submit submit-receive" onclick="openModal('#modalTripEvaluation{{ $request->id }}');">Receive and comment</button>
                                    @endif
                                </div>

                                <div class="modal fade modal-evaluation" id="modalTripEvaluation{{ $request->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal body -->
                                            <p class="title ">
                                                Evaluation
                                            </p>
                                            <div class="evaluation-notice">
                                                <i class="fas fa-exclamation-circle mr-3"></i>
                                                <p>
                                                    Share your impressions about the service to encourage our travelers.
                                                </p>
                                            </div>
                                            <div class="evaluation-note">
                                                <div class="rates"></div>
                                                <div class="reasons reasons-bad ">
                                                    <div class="btn-reason active btn-reason-first" data-reason="Deliver overtime">Deliver overtime</div>
                                                    <div class="btn-reason" data-reason="Bad communication">Bad communication</div>
                                                    <div class="btn-reason" data-reason="Accommodating">Accommodating</div>
                                                    <div class="btn-reason" data-reason="Damage item">Damage item</div>
                                                </div>
                                                <div class="reasons reasons-good">
                                                    <div class="btn-reason active btn-reason-first" data-reason="Delivery on time">Delivery on time</div>
                                                    <div class="btn-reason" data-reason="Good communication">Good communication</div>
                                                    <div class="btn-reason" data-reason="Accommodating">Accommodating</div>
                                                    <div class="btn-reason" data-reason="Perferct item">Perferct item</div>
                                                </div>
                                                <textarea id="description" placeholder="Please share what you like..."></textarea>
                                            </div>
                                            <div class="evaluation-buttons">
                                                <button class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-black submit" data-dismiss="modal" onclick="postComments({{ $request->id }}, 'Trip')">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    </div>
                    <div class="tab-pane fade " id="package" role="tabpanel" aria-labelledby="package-tab">
                        <select class="form-control mb-3 select-status" id="package_option">
                            <option value="package_from_applicant">From the applicant</option>
                            <option value="package_from_you">From you</option>
                        </select>
                        <div id="package_from_applicant" class="package_from">
                            @foreach($requestApplicant as $request)
                            <div class="card" id="package_request_{{ $request->id }}">
                                <div class="person__card">
                                    <div class="person__card-name">
                                        {{ $request->package->hasOneUser->getName() }}
                                    </div>
                                    <div class="person__card-date">
                                        Joined: {{ date('Y/m/d', strtotime($request->package->hasOneUser->created_at)) }}
                                    </div>
                                    <img src="{{ asset($request->package->hasOneUser->avatarImage()) }}" alt="person" class="d-block mt-2 mb-2 ml-auto mr-auto">
                                    <div class="person__card-date">
                                        Online<br>Begin
                                    </div>
                                </div>
                                <div class="card_info">
                                    <div class="col-12 mb-3">
                                        <div class=""><span>Request date:</span> {{ date('Y/m/d', strtotime($request->created_at)) }}</div>
                                        <div class=""><span>From: </span> {{ $request->package->begin_place }}</div>
                                        <div class=""><span>To: </span> {{ $request->package->arrival_place }}</div>
                                        <div class=""><span>Description: </span> {{ $request->description }}</div>
                                        <div class=" font-weight-normal"><span class="red">Estimated deliver time: <br></span> {{ date('Y/m/d h:i', strtotime($request->package->begin_time)) }} - {{ date('Y/m/d h:i', strtotime($request->package->arrival_time)) }}</div>
                                        <div class=" font-weight-normal"><span class="red">Reality deliver time: </span> {{ date('Y/m/d') }}</div>
{{--                                        <div>--}}
{{--                                            <img src="../../../public/images/book.png" alt="item" height="118" class="d-block m-auto w-85">--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <button class="btn btn-black submit submit-receive" onclick="updateStatus({{ $request->id }}, {{ Config::get('constants.status.sent') }}, 'package')">Send</button>
                            </div>
                            @endforeach
                        </div>
                        <div id="package_from_you" class="package_from" style="display: none;">
                            @foreach($requestPackageFromYou as $request)
                                <div class="card" id="package_request_{{ $request->id }}">
                                    <div class="person__card">
                                        <div class="person__card-name">
                                            {{ $request->package->hasOneUser->getName() }}
                                        </div>
                                        <div class="person__card-date">
                                            Joined: {{ date('Y/m/d', strtotime($request->package->hasOneUser->created_at)) }}
                                        </div>
                                        <img src="{{ asset($request->package->hasOneUser->avatarImage()) }}" alt="person" class="d-block mt-2 mb-2 ml-auto mr-auto">
                                        <div class="person__card-date">
                                            Online<br>Begin
                                        </div>
                                    </div>
                                    <div class="card_info">
                                        <div class="col-12 mb-3">
                                            <div class=""><span>Request date:</span> {{ date('Y/m/d', strtotime($request->created_at)) }}</div>
                                            <div class=""><span>From: </span> {{ $request->package->begin_place }}</div>
                                            <div class=""><span>To: </span> {{ $request->package->arrival_place }}</div>
                                            <div class=""><span>Description: </span> {{ $request->description }}</div>
                                            <div class=" font-weight-normal"><span class="red">Estimated deliver time: <br></span> {{ date('Y/m/d h:i', strtotime($request->package->begin_time)) }} - {{ date('Y/m/d h:i', strtotime($request->package->arrival_time)) }}</div>
                                            <div class=" font-weight-normal"><span class="red">Reality deliver time: </span> {{ date('Y/m/d') }}</div>
                                            {{--                                        <div>--}}
                                            {{--                                            <img src="../../../public/images/book.png" alt="item" height="118" class="d-block m-auto w-85">--}}
                                            {{--                                        </div>--}}
                                        </div>
                                    </div>
                                    <button class="btn btn-black submit submit-receive" onclick="openModal('#modalPackageEvaluation{{ $request->id }}');">Confirm and comment</button>
                                </div>

                                <div class="modal fade modal-evaluation" id="modalPackageEvaluation{{ $request->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal body -->
                                            <p class="title ">
                                                Evaluation
                                            </p>
                                            <div class="evaluation-notice">
                                                <i class="fas fa-exclamation-circle mr-3"></i>
                                                <p>
                                                    Share your impressions about the service to encourage our travelers.
                                                </p>
                                            </div>
                                            <div class="evaluation-note">
                                                <div class="rates"></div>
                                                <div class="reasons reasons-bad ">
                                                    <div class="btn-reason active btn-reason-first" data-reason="Deliver overtime">Deliver overtime</div>
                                                    <div class="btn-reason" data-reason="Bad communication">Bad communication</div>
                                                    <div class="btn-reason" data-reason="Accommodating">Accommodating</div>
                                                    <div class="btn-reason" data-reason="Damage item">Damage item</div>
                                                </div>
                                                <div class="reasons reasons-good">
                                                    <div class="btn-reason active btn-reason-first" data-reason="Delivery on time">Delivery on time</div>
                                                    <div class="btn-reason" data-reason="Good communication">Good communication</div>
                                                    <div class="btn-reason" data-reason="Accommodating">Accommodating</div>
                                                    <div class="btn-reason" data-reason="Perferct item">Perferct item</div>
                                                </div>
                                                <textarea id="description" placeholder="Please share what you like..."></textarea>
                                            </div>
                                            <div class="evaluation-buttons">
                                                <button class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-black submit" data-dismiss="modal" onclick="postComments({{ $request->id }}, 'Package')">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

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
            $("#trip_option").change(function () {
                $('.trip_from').hide();
                let place = $(this).val();
                $('#' + place).show();
            });

            $("#package_option").change(function () {
                $('.package_from').hide();
                let place = $(this).val();
                $('#' + place).show();
            });

            $('.btn-reason').click(function (ev) {
                $('.btn-reason').removeClass('active');
                $(ev.target).addClass('active');

            });

            $(".rates").rateYo().on("rateyo.set", function (e, data) {
                var rating = data.rating;
                if (rating < 3) {
                    $('.reasons-bad').css('display', 'flex');
                    $('.reasons-good').css('display', 'none');
                } else {
                    $('.reasons-bad').css('display', 'none');
                    $('.reasons-good').css('display', 'flex');
                }
            });

        });

        updateStatus = function (id, status, type) {
            $.ajax({
                url: "{{ route('status.update') }}",
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : id,
                    'status': status,
                    'type': type
                },
                success: function(data) {
                    if (data.success == true) {
                        if (type == 'trip') {
                            $('#trip_request_' + id).remove();
                        }
                        else {
                            $('#package_request_' + id).remove();
                        }

                    }
                }
            });
        }

        openModal = function (modal) {
            $(modal).modal('show');
        }

        postComments = function (id, type) {
            let rating = $('#modal' + type + 'Evaluation'+id).find('.rates').rateYo('rating');
            let basicReason = $('#modalEvaluation'+id).find('.reasons-bad').css('display') == 'none' ?
                $('#modal' + type + 'Evaluation'+id).find('.reasons-good').find('.btn-reason.active').html() :
                $('#modal' + type + 'Evaluation'+id).find('.reasons-bad').find('.btn-reason.active').html()
            let description = $('#modal' + type + 'Evaluation'+id).find('#description').val();
            $.ajax({
                url: "{{ route('status.feedback') }}",
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'request-id' : id,
                    'rating' : rating,
                    'title': basicReason,
                    'description': description,
                    'type': type
                },
                success: function(data) {
                    if (data.success == true) {
                        if (type == 'Trip') {
                            $('#trip_request_' + id).remove();
                        }
                        else {
                            $('#package_request_' + id).remove();
                        }
                        if ($('#modal' + type + 'Evaluation' + id).hasClass('show')) {
                            $('#modal' + type + 'Evaluation' + id).remove();
                        }
                    }
                }
            });
        }
    </script>
@endpush
