@extends('layouts.mobile',['page' => __($page), 'pageSlug' => $page_slug])

@section('content')
    <!-- start content -->
    <div class="container-fluid content search has-btn-footer ">
        <div class="row no-gutters">
            @include('alerts.error')
            @include('alerts.success')
            <div class="col-12">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ (session('pickup')) ? session('pickup') : '' }} {{ (!session('send') && !session('pickup')) ? 'active' : '' }}" id="pickup-tab" data-toggle="pill" href="#pickup" role="tab" aria-controls="Pickup" aria-selected="true">Pickup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (session('send')) ? session('send') : '' }}" id="send-tab" data-toggle="pill" href="#send" role="tab" aria-controls="Send" aria-selected="false">Send</a>
                    </li> 
                </ul>
                <div class="tab-content container-fluid p-0" id="pills-tabContent">
                    <div class="tab-pane fade {{ (session('pickup')) ? session('pickup').' show' : '' }} {{ (!session('send') && !session('pickup')) ? 'active show' : '' }}" id="pickup" role="tabpanel" aria-labelledby="waiting-tab">
                        @if(count($trips) > 0)
                            @foreach($trips as $key => $value)
                                <a href="{{ route('trip.show',['id' => $value->id]) }}" title="">
                                    <div class="ps-1">
                                        <div class="image">
                                            <img src="{{ asset($value->hasOneUser->avatarImage()) }}" alt="">
                                            <div class="c-rq">
                                                <span>
                                                    {{ $value->count_request() }} Requests<br>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ctent">
                                            <h6>{{ $value->hasOneUser->getname() }}</h6>
                                            <p>From <span>{{ $value->hasOne_begin_place->name }}</span></p>
                                            <p>To <span>{{ $value->hasOne_arrival_place->name }}</span></p>
                                            <p>{{ \Carbon\Carbon::parse($value->begin_time)->format('Y-m-d g:i A') }} -> {{ \Carbon\Carbon::parse($value->arrival_time)->format('Y-m-d g:i A') }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <img src="{{ asset('images/icon/nothig.png') }}" alt="" class="w-100">
                        @endif
                        
                        @if(Auth::user())
                            <div class="wrp-btn">
                                <a href="{{ route('trip.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100">Post Your Trip</button></a>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade {{ (session('send')) ? session('send').' show' : '' }}" id="send" role="tabpanel" aria-labelledby="completed-tab">
                        @if(count($trips) > 0)
                            @foreach($packages as $key => $value)
                                <a href="{{ route('package.show',['id' => $value->id]) }}" title="">
                                    <div class="ps-1">
                                        <div class="image">
                                            <img src="{{ asset($value->hasOneUser->avatarImage()) }}" alt="">
                                            <div class="c-rq">
                                                <span>
                                                    {{ $value->count_request() }} Requests <br>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ctent">
                                            <h6>{{ $value->hasOneUser->getname() }}</h6>
                                            <p>From <span>{{ $value->hasOne_begin_place->name }}</span></p>
                                            <p>To <span>{{ $value->hasOne_arrival_place->name }}</span></p>
                                            <p>{{ \Carbon\Carbon::parse($value->begin_time)->format('Y-m-d g:i A') }} -> {{ \Carbon\Carbon::parse($value->arrival_time)->format('Y-m-d g:i A') }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @else
                            <img src="{{ asset('images/icon/nothig.png') }}" alt="" class="w-100">
                        @endif
                        @if(Auth::user())
                            <div class="wrp-btn">
                                <a href="{{ route('package.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100">Post Your Parcel</button></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content -->

@endsection
@push('css')
    <link  rel="stylesheet" href="{{ asset('css/autocomplete_country.css') }}">
    <style type="text/css">
        .daterangepicker.opensright:before {
            left: 210px;
        }
        .daterangepicker.opensright:after {
            left: 211px;
        }
    </style>
@endpush
@push('js')
<script src="{{ asset('js/autocomplete_country.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.search__card').click(function(event) {
            var id = $(this).attr('data');
            $('.modalPackageDetail_'+id).modal('show');
        });
        $("input[name*='arrival_time']").click(function () {
            $(".show-calendar").css('left', '25%');
        });
        var handleClick = debounce(function (e) {
        var val = $(this).val();
        var self = $(this);
        if (val == '') {
            return false;
        }
        $.ajax({
            url:"{{ route('home.search.autocomplete') }}",
            type:"GET",
            data:{'name':val},
            success:function (data) {
                if (data.length <= 0) {
                    self.removeAttr('data-id');
                }
                autocomplete(self,val,data);
            }
        })
        }, 500);

        $('.searching').on('keyup',handleClick);

    })
</script>
@endpush
