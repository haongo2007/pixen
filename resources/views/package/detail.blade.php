@extends('layouts.mobile',['pageSlug' => 'package','nav_color' => 'bg-silver'])

@section('content')
    <!-- start content -->
    <div class="container-fluid head">
        <div class="avatar">
            <img src="{{ asset($package->hasOneUser->avatarImage()) }}" alt="">
        </div>
        <h4 class="text-capitalize">{{ $package->hasOneUser->getName() }}</h4>
        <div class="rate" data="{{ ($package->hasOneUser->rate_total != 0 ) ? $package->hasOneUser->rate_total / $package->hasOneUser->rate_count : 0 }}">

        </div>
    </div>
    <div class="container-fluid content package package-detail has-btn-footer ">
        <div class="row no-gutters detail__wrap">
            @include('alerts.error')
            <div class="col-12 mb-3 body">
                <div class="emp_luggage">
                    <b>Package : {{ $package->name }}</b> <b> {{ ucwords($package->size) }} (kg) </b>
                </div>
                <div class="sec row">
                    <div class="col">
                        <b>{{ $package->hasOne_begin_place->code }}</b><br>
                        <span>{{ $package->hasOne_begin_place->iso_country }}</span><br>
                    </div>
                    <div class="col plane">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </div>
                    <div class="col">
                        <b>{{ $package->hasOne_arrival_place->code }}</b><br>
                        <span>{{ $package->hasOne_arrival_place->iso_country }}</span><br>
                    </div>
                    <div class="time">
                        <span>{{ \Carbon\Carbon::parse($package->begin_time)->format('Y-m-d g:i A') }}</span>
                        
                        <span>{{ \Carbon\Carbon::parse($package->arrival_time)->format('Y-m-d g:i A') }}</span>
                    </div>
                </div>
                <b class="description">Description:</b>
                <p>{{ $package->description }}</p>
            </div>
            <div class="col-12 mb-3 request">
                {{-- @php 
                    $ar = [];
                @endphp --}}
                @if(Auth::user()->id == $package->user_id)
                    @if(count($package->requests))
                        <b class="requested">Requested:</b>
                        @foreach($package->requests as $item)
                            {{-- @php
                                array_push($ar, $item->user_send);
                            @endphp --}}
                            <a 
                                @if($package->disable == 0)
                                    href="{{ route('package.request.detail',['id' => $item->id]) }}"
                                @endif>
                                <div class="trip__card row no-gutters p-2">
                                    <div class="lf">
                                        <img src="{{ asset($item->Avatar_user_pickup()) }}" alt="">
                                        <div class="t">
                                            <b>{{ $item->Name_user_pickup() }}</b><br>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="rg">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        <span>{{ $item->Trip->size }} kg</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                @else
                    @if(count($package->Myrequests))
                        <b class="requested">Requested:</b>
                        @foreach($package->Myrequests as $item)
                            {{-- @php
                                array_push($ar, $item->user_send);
                            @endphp --}}
                            <a 
                                @if($package->disable == 0)
                                    href="{{ route('package.request.detail',['id' => $item->id]) }}"
                                @endif>
                                <div class="trip__card row no-gutters p-2">
                                    <div class="lf">
                                        <img src="{{ asset($item->Avatar_user_pickup()) }}" alt="">
                                        <div class="t">
                                            <b>{{ $item->Name_user_pickup() }}</b><br>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="rg">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        <span>{{ $item->Trip->size }} kg</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                @endif
            </div> 
            @if(Auth::user()->id != $package->user_id)
                <div class="wrp-btn">
                    <a href="{{ route('package.request',['id'=> $package->id]) }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100">Request</button></a>  
                </div>
            @endif
        </div>
    </div>

@endsection
