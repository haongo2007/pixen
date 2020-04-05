@extends('layouts.mobile',['page' => 'Detail payment','pageSlug' => 'detail'])

@section('content')
    <!-- start content -->

    <div class="container-fluid content package payment has-btn-footer ">
        
        <div class="row no-gutters detail__wrap">
            @include('alerts.success')
            <div class="container-fluid head mb-0">
                <div class="avatar">
                    <img src="{{ asset($invoice->hasOne_request_send->Trip->hasOneUser->avatarImage()) }}" alt="">
                </div>
                <h4 class="text-capitalize">{{ $invoice->hasOne_request_send->Trip->hasOneUser->getName() }}</h4>
                <div class="rate"  data="{{ ( $invoice->hasOne_request_send->Trip->hasOneUser->rate_total != 0 ) ? $invoice->hasOne_request_send->Trip->hasOneUser->rate_total / $invoice->hasOne_request_send->Trip->hasOneUser->rate_count : 0 }}">
                    
                </div>
            </div>
            <div class="col-12 mb-3 body">
                <div class="sec row">
                    <div class="col">
                        <b>{{ $invoice->hasOne_request_send->Trip->hasOne_begin_place->code }}</b><br>
                        <span>{{ $invoice->hasOne_request_send->Trip->hasOne_begin_place->iso_country }}</span><br>
                    </div>
                    <div class="col plane">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </div>
                    <div class="col">
                        <b>{{ $invoice->hasOne_request_send->Trip->hasOne_arrival_place->code }}</b><br>
                        <span>{{ $invoice->hasOne_request_send->Trip->hasOne_arrival_place->iso_country }}</span><br>
                    </div>
                    <div class="time">
                        <span class="w-32 text-center">
                            <b>DEPARTURE</b>
                            <span>{{ \Carbon\Carbon::parse($invoice->hasOne_request_send->Trip->begin_time)->calendar() }}</span>
                        </span>
                        
                        <span class="w-32 text-center">
                            <b>ARRIVAL</b><br>
                            <span>{{ \Carbon\Carbon::parse($invoice->hasOne_request_send->Trip->arrival_time)->calendar() }}</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="foot">
                <div class="emp_luggage">
                    <b>Package </b>
                    <b> {{ $invoice->hasOne_request_send->Trip->size }} (kg) </b>
                </div>
                <div class="emp_luggage {{ ($invoice->paid == 0) ? 'bg-notyet' : 'bg-success' }}">
                    @if($invoice->hasOne_request_send->user_recei == Auth::user()->id)
                        <b>{{ ($invoice->paid == 0) ? "haven't received yet " : "Received" }}</b>
                    @else
                        <b>{{ ($invoice->paid == 0) ? 'send' : 'sent' }}</b>
                    @endif
                    <b> {{ number_format($invoice->price) }} (USD) </b>
                </div>
            </div>
            <div class="col-12 mb-3 request">
                <b class="requested">Requested:</b>      
                <a href="#" >
                    <div class="trip__card row no-gutters p-2">
                        <div class="lf">
                            <img src="{{ asset($invoice->hasOne_request_send->Avatar_user()) }}" alt="">
                            <div class="t">
                                <b>{{ $invoice->hasOne_request_send->Name_user() }}</b><br>
                                <span>{{ \Carbon\Carbon::parse($invoice->hasOne_request_send->created_at)->calendar() }}</span>
                            </div>
                        </div>
                        <div class="rg">
                            <i class="fa fa-suitcase" aria-hidden="true"></i>
                            <span>{{ $invoice->hasOne_request_send->Package->size }} kg</span>
                        </div>
                    </div>
                </a>
            </div>
            @if($invoice->paid == 0 && Auth::user()->id !== $invoice->hasOne_request_send->Trip->user_id)
                <div class="wrp-btn">
                    <a href="{{ route('paypal.checkout',['id' => $invoice->id]) }}" class="d-contents">
                        <button class="btn btn-outline-primary w-100">
                            <img src="{{ asset('images/icon/paypal.svg') }}" width="100px" alt="">
                        </button>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection