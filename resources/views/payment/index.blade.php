@extends('layouts.mobile',['page' => __('Payment'), 'pageSlug' => 'payment'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content search has-btn-footer ">
        <div class="row no-gutters">
            @include('alerts.error')
            @include('alerts.success')
            <div class="col-12">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="Pickup" aria-selected="true">All Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="receive-tab" data-toggle="pill" href="#receive" role="tab" aria-controls="Receive" aria-selected="false">Receive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="send-tab" data-toggle="pill" href="#send" role="tab" aria-controls="Send" aria-selected="false">Send</a>
                    </li> 
                </ul>
                <div class="tab-content container-fluid p-0" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="waiting-tab">
                        @foreach($recei as $key => $value)
                            <a href="{{ route('payment.detail',['id' => $value->id]) }}" title="">
                                <div class="ps-1">
                                    <div class="image">
                                        <img src="{{ $value->hasOne_request_send->Avatar_user() }}" alt="">
                                    </div>
                                    <div class="ctent w-100 d-grid align-items-center"> 
                                        <h6>{{ $value->hasOne_request_send->Name_user() }}</h6>
                                        <p><span>{{ \Carbon\Carbon::parse($value->updated_at)->calendar() }}</span></p>
                                    </div>
                                    <div class="price d-grid align-items-center w-52">
                                        <span class="money">{{ number_format($value->price) }} $</span>
                                        @if($value->paid == 0)
                                            <span class="badg bg-pixen">
                                                pending
                                            </span>
                                            @else
                                            <span class="badg bg-success">
                                                received
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        @foreach($send as $key => $value)
                            <a href="{{ route('payment.detail',['id' => $value->id]) }}" title="">
                                <div class="ps-1">
                                    <div class="image">
                                        <img src="{{ $value->hasOne_request_send->Trip->hasOneUser->avatarImage() }}" alt="">
                                    </div>
                                    <div class="ctent w-100 d-grid align-items-center"> 
                                        <h6>{{ $value->hasOne_request_send->Trip->hasOneUser->getName() }}</h6>
                                        <p><span>{{ \Carbon\Carbon::parse($value->created_at)->calendar() }}</span></p>
                                    </div>
                                    <div class="price d-grid align-items-center w-52">
                                        <span class="money">{{ number_format($value->price) }} $</span>
                                        @if($value->paid == 0)
                                            <span class="badg bg-pixen">
                                                pending
                                            </span>
                                            @else
                                            <span class="badg bg-success">
                                                Sent
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="tab-pane fade show" id="receive" role="tabpanel" aria-labelledby="waiting-tab">
                        @foreach($recei as $key => $value)
                            <a href="{{ route('payment.detail',['id' => $value->id]) }}" title="">
                                <div class="ps-1">
                                    <div class="image">
                                        <img src="{{ $value->hasOne_request_send->Avatar_user() }}" alt="">
                                    </div>
                                    <div class="ctent w-100 d-grid align-items-center"> 
                                        <h6>{{ $value->hasOne_request_send->Name_user() }}</h6>
                                        <p><span>{{ \Carbon\Carbon::parse($value->updated_at)->calendar() }}</span></p>
                                    </div>
                                    <div class="price d-grid align-items-center w-52">
                                        <span class="money">{{ number_format($value->price) }} $</span>
                                        @if($value->paid == 0)
                                            <span class="badg bg-pixen">
                                                pending
                                            </span>
                                            @else
                                            <span class="badg bg-success">
                                                received
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="tab-pane fade show" id="send" role="tabpanel" aria-labelledby="waiting-tab">
                        @foreach($send as $key => $value)
                            <a href="{{ route('payment.detail',['id' => $value->id]) }}" title="">
                                <div class="ps-1">
                                    <div class="image">
                                        <img src="{{ $value->hasOne_request_send->Trip->hasOneUser->avatarImage() }}" alt="">
                                    </div>
                                    <div class="ctent w-100 d-grid align-items-center"> 
                                        <h6>{{ $value->hasOne_request_send->Trip->hasOneUser->getName() }}</h6>
                                        <p><span>{{ \Carbon\Carbon::parse($value->created_at)->calendar() }}</span></p>
                                    </div>
                                    <div class="price d-grid align-items-center w-52">
                                        <span class="money">{{ number_format($value->price) }} $</span>
                                        @if($value->paid == 0)
                                            <span class="badg bg-pixen">
                                                pending
                                            </span>
                                            @else
                                            <span class="badg bg-success">
                                                Sent
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content -->

@endsection


{{-- <div class="wrp-btn">
    <a href="{{ route('package.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100">Pay with Paypal</button></a>
</div> --}}