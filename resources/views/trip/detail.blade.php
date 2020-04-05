@extends('layouts.mobile',['pageSlug' => 'trip','nav_color' => 'bg-silver'])

@section('content')
    <!-- start content -->
    <div class="container-fluid head">
        <div class="avatar">
            <img src="{{ asset($trip->hasOneUser->avatarImage()) }}" alt="">
        </div>
        <h4 class="text-capitalize">{{ $trip->hasOneUser->getName() }}</h4>
        <div class="rate" data="{{ ($trip->hasOneUser->rate_total != 0 ) ? $trip->hasOneUser->rate_total / $trip->hasOneUser->rate_count : 0 }}">

        </div>
    </div>
    <div class="container-fluid content package package-detail has-btn-footer ">
        <div class="row no-gutters detail__wrap">
            <div class="col-12 mb-3 body">
                <div class="emp_luggage">
                    <b>Size</b> <b> {{ ucwords($trip->size) }} (kg) </b>
                </div>
                <div class="sec row">
                    <div class="col">
                        <b>{{ $trip->hasOne_begin_place->code }}</b><br>
                        <span>{{ $trip->hasOne_begin_place->iso_country }}</span><br>
                    </div>
                    <div class="col plane">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </div>
                    <div class="col">
                        <b>{{ $trip->hasOne_arrival_place->code }}</b><br>
                        <span>{{ $trip->hasOne_arrival_place->iso_country }}</span><br>
                    </div>
                    <div class="time">
                        <span>{{ \Carbon\Carbon::parse($trip->begin_time)->format('Y-m-d g:i A') }}</span>
                        
                        <span>{{ \Carbon\Carbon::parse($trip->arrival_time)->format('Y-m-d g:i A') }}</span>
                    </div>
                </div>
                <b class="description">Description:</b>
                <p>{{ $trip->description }}</p>
            </div>
            <div class="col-12 mb-3 request">
               {{--  @php 
                    $ar = [];
                @endphp --}}

                @if(Auth::user()->id == $trip->user_id)
                    @if(count($trip->requests))
                        <b class="requested">Requested:</b>
                        @foreach($trip->requests as $item)
                            {{-- @php
                                array_push($ar, $item->user_send);
                            @endphp --}}
                            <a 
                                @if($trip->disable == 0)
                                    href="{{ route('trip.request.detail',['id' => $item->id]) }}"
                                @endif>
                                <div class="trip__card row no-gutters p-2">
                                    <div class="lf">
                                        <img src="{{ asset($item->Avatar_user()) }}" alt="">
                                        <div class="t">
                                            <b>{{ $item->Name_user() }}</b><br>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="rg">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        <span>{{ $item->Package->size }} kg</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                @else
                    @if(count($trip->Myrequests))
                        <b class="requested">Requested:</b>
                        @foreach($trip->Myrequests as $item)
                            {{-- @php
                                array_push($ar, $item->user_send);
                            @endphp --}}
                            <a 
                                @if($trip->disable == 0)
                                    href="{{ route('trip.request.detail',['id' => $item->id]) }}"
                                @endif>
                                <div class="trip__card row no-gutters p-2">
                                    <div class="lf">
                                        <img src="{{ asset($item->Avatar_user()) }}" alt="">
                                        <div class="t">
                                            <b>{{ $item->Name_user() }}</b><br>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="rg">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        <span>{{ $item->Package->size }} kg</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                @endif
            </div>
            @if(Auth::user()->id != $trip->user_id)
                <div class="wrp-btn">
                    <a href="{{ route('trip.request',['id'=> $trip->id]) }}" class="d-contents">
                        <button class="btn btn-pixen bg-pixen w-100">Request</button>
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection
@push('css')
    <style type="text/css" media="screen">
        .active{
            color: #fe8c81!important;
        }
        .active .trip__card{
            background: #eee;
            border-radius: 8px;
        }
    </style>
@endpush