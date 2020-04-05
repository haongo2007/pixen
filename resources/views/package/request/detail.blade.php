@extends('layouts.mobile',['pageSlug' => 'request','nav_color' => 'bg-silver' ])

@section('content')
    <!-- start content -->
    <div class="container-fluid head">
        <div class="avatar">
            <img src="{{ asset($request->avatar_user_pickup()) }}" alt="">
        </div>
        <h4 class="text-capitalize">{{ $request->Name_user_pickup() }}</h4>
        <div class="rate">
            
        </div>
    </div>
        <div class="container-fluid content package package-detail has-btn-footer ">
        
        <div class="row no-gutters detail__wrap">
            <div class="col-12 mb-3 body">
                <div class="emp_luggage">
                    <b>Size </b> <b> {{ ucwords($request->Trip->size) }} (kg) </b>
                </div>
                <div class="sec row">
                    <div class="col">
                        <b>{{ $request->Trip->hasOne_begin_place->code }}</b><br>
                        <span>{{ $request->Trip->hasOne_begin_place->iso_country }}</span><br>
                    </div>
                    <div class="col plane">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </div>
                    <div class="col">
                        <b>{{ $request->Trip->hasOne_arrival_place->code }}</b><br>
                        <span>{{ $request->Trip->hasOne_arrival_place->iso_country }}</span><br>
                    </div>
                    <div class="time">
                        <span>{{ \Carbon\Carbon::parse($request->Trip->begin_time)->format('Y-m-d g:i A') }}</span>
                        
                        <span>{{ \Carbon\Carbon::parse($request->Trip->arrival_time)->format('Y-m-d g:i A') }}</span>
                    </div>
                </div>
                <b class="description">Message:</b>
                <p>{{ $request->Trip->description }}</p>
            </div>
            @if(Auth::user()->id == $request->user_send)
                <div class="d-flex w-100 justify-content-space-evenly">
                    <a href="{{ route('request.decline',['id'=>$request->id,'redirect' => 'package','to'=> $request->package_id]) }}" class="d-contents"><button class="btn btn-dark w-40">Decline</button></a>
                    <button class="btn btn-pixen bg-pixen w-40" data-toggle="modal" data-target="#modal-create-invoice">Accept</button>
                </div>
            @endif
            <div class="col-12 mt-4 request">
                <b class="requested">Comments:</b>
                <div class="fr-cmt mb-4">
                    @foreach($request->Getcomments as $value)

                    <div class="trip__card row no-gutters p-2">
                        <div class="lf">
                            <img src="{{ asset($value->user->avatarImage()) }}" alt="">
                            <div class="t d-flex align-items-center">
                                <b>{{ $value->user->getName() }}</b><br>
                            </div>
                        </div>
                        <span>{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
                        {{-- <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item edit_cm" href="javascript:void(0)" id="{{ $value->id }}">{{ __('Edit') }}</a>
                                <a class="dropdown-item dele_cm" href="javascript:void(0)" id="{{ $value->id }}">{{ __('Delete') }}</a>
                            </div>
                        </div> --}}
                        <div class="d-flex w-100">
                            <p class="mb-0 w-100 box-mess mr-4" contenteditable="false">{{ $value->message }}</p>
                            <img src="{{ asset('images/icon/next.svg') }}" width="20" alt="" class="d-none send_ed">
                        </div>
                        @if($value->user_id == Auth::user()->id)
                            <i class="fa fa-times dele_cm cursor" aria-hidden="true" id="{{ $value->id }}"></i>
                        @endif
                    </div>

                    @endforeach
                </div>

                <div class="cpn-ins d-flex">
                    <input class="text_cmt" type="text" placeholder="write a comment" name="text">
                    <button type="button" class="send_cmt" uid="{{ Auth::user()->id }}" rid="{{ $request->id }}">
                        <img src="{{ asset('images/icon/next.svg') }}" width="20" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->id == $request->user_send)
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-create-invoice">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('package.create.invoice',['id'=>$request->id]) }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Enter Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group w-100">
                                <label for="arrival_place">Price negotiated successfully</label>
                                <input type="text" data-type='number' name="price" class="form-control" required placeholder="1,000,000">
                                <span class="separator"></span>
                                <span class="unit">($) USD</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success btn-block" type="submit" >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('css')
    <style type="text/css" media="screen">
        .unit{
            position: absolute;
            right: 0;
            bottom: 14px;
            color: #000;
            font-size: 15px;
        }
    </style>
@endpush
@push('js')
<script>
    var token = '{{ csrf_token() }}';
    $("input[data-type='number']").keyup(function(event){
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
        }
        var $this = $(this);
        var num = $this.val().replace(/,/gi, "");
        var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
        console.log(num2);
        // the following line has been simplified. Revision history contains original.
        $this.val(num2);
    });   
    $('.request').on('click','.send_cmt',function(event) {
        var rid = $(this).attr('rid');
        var uid = $(this).attr('uid');
        var mess = $('.text_cmt').val();
        if (mess.length > 1) {
            $.ajax({
                url: '{{ route('comments.add') }}',
                type: 'POST',
                data: {uid:uid,rid:rid,_token:token,mess:mess },
            })
            .done(function(data,textStatus) {
                $('.text_cmt').val('');
                if (textStatus == 'success') {
                    $('.fr-cmt').prepend(data);
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
        }
    });
    $('.request').on('click','.edit_cm',function(event) {
        event.preventDefault();
        /* reset val */
        $('.box-mess').attr('contenteditable', 'false');
        $('.send_ed').addClass('d-none');
        var id = $(this).attr('id');
        var box_mess = $(this).parents('.trip__card').find('.box-mess');
        var but_send = $(this).parents('.trip__card').find('.send_ed');
        box_mess.attr('contenteditable', 'true');
        box_mess.focus();
        but_send.removeClass('d-none');
        box_mess.blur(function(event) {
            but_send.addClass('d-none');
            box_mess.attr('contenteditable', 'false');
        });
        $('.request').on('click','.send_ed',function(event) {
            var mess = box_mess.text();
            $.ajax({
                url: '{{ route('comments.update') }}',
                type: 'POST',
                data: {_token:token,id:id,mess:mess},
            })
            .done(function(data) {
                if (data == 200) {
                    $('.send_ed').addClass('d-none');
                    box_mess.attr('contenteditable', 'false');
                }
            })
        });
        
    });
    $('.request').on('click','.dele_cm',function(event) {
        if (confirm('Are you sure you want to delete this record')) {
            var id = $(this).attr('id');
            var _this = $(this);
            $.ajax({
                url: '{{ route('comments.delete') }}',
                type: 'GET',
                data: {_token:token,id:id },
            })
            .done(function(data) {
                if (data == 200) {
                    _this.parents('.trip__card').fadeOut('slow');
                }
            })
        }
    });
</script>   
@endpush