@extends('layouts.mobile',['page' => __('Notification'), 'pageSlug' => 'notifications'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content notification has-btn-footer">
        @foreach($noti as $key => $value)
            <a href="{{ $value->redirection }}" title="">
                <div class="row noti__blocks mt-2">
                    <div class="col-12">
                        <div class="noti__block justify-content-between">
                            <p class="mb-0">
                                <b>{{ $value->From_user->getName() }}</b>
                                <span class="noti__block-message" > {{ $value->message }}</span>
                            </p>
                            <img src="{{ asset($value->From_user->avatarImage()) }}" class="rounded-circle">
                        </div>
                        <div class="noti__block-time">
                            <i class="fas fa-history"></i>
                            <small>{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <!-- end main content -->
@endsection
