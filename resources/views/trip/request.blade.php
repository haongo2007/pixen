{{-- @extends('layouts.mobile',['page' => __('Create Request'), 'pageSlug' => 'create-request'])

@section('content')
    <div class="container-fluid content package package-detail has-btn-footer ">
        <div class="row title-wrap  no-gutters">
            <div class="col-12">
                <div class="title">Choose Your Package or create new</div>
            </div>
        </div>
        <div class="row no-gutters detail__wrap">
            <div class="col-12 mb-3 body">
                <div class="alert alert-dismissible fade show d-none" role="alert">
                    <strong class="state"></strong> <span class="ctx"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @foreach($packages as $key => $package)
                <div class="sec row {{ ($key == 0) ? 'book-active' : '' }}" rq="{{ $package->id }}">
                    <div class="col">
                        <b>{{ $package->hasOne_begin_place->iata_code }}</b><br>
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
                        <b>{{ $package->hasOne_arrival_place->iata_code }}</b><br>
                        <span>{{ $package->hasOne_arrival_place->iso_country }}</span><br>
                    </div>
                    <div class="time">
                        <span class="w-32 text-center"><b>Date</b></span>
                        
                        <span>{{ \Carbon\Carbon::parse($package->date_send)->calendar() }}</span>
                    </div>
                    <div class="time">
                        <span class="w-32 text-center"><b>Package: {{ $package->name }}</b></span>
                        <span><b>{{ ucwords($package->size) }} (kg) </b></span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex w-100 justify-content-between gh">
                @if(count($packages) > 0)
                    <a href="javascript:void(0)" class="d-contents send-rq"><button class="btn btn-pixen bg-success w-40 mt-4">Request</button></a>
                @endif
                <a href="{{ route('package.create_send',['tripId' => $tripId]) }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-40 mt-4">Create a new package</button></a>
            </div>
        </div>
    </div>
</div>

<!-- end main content -->
@endsection
@push('css')
    <link  rel="stylesheet" href="{{ asset('css/autocomplete_country.css') }}">
@endpush
@push('js')
    <script>
        $('.sec').click(function(event) {
            $('.sec').removeClass('book-active');
            $(this).addClass('book-active');
        });
        $('.send-rq').click(function(event) {
            var id_package = $('.book-active').attr('rq');
            var id_trip = `{{ $tripId }}`;
            var token = `{{ csrf_token() }}`
            var _this = $(this).children('button');
            $.ajax({
                url: '{{ route('trip.request.save') }}',
                type: 'POST',
                data: {id_tr: id_trip,id_pa: id_package,_token:token},
                beforeSend: function(){
                    _this.html('Loading...');
                    _this.attr('disabled', true);
                },
            })
            .done(function(data) {
                if (data == '200') {
                    $('.alert').addClass('alert-success');
                    $('.alert').removeClass('d-none');
                    $('.alert').find('.state').html('Success');
                    $('.alert').find('.ctx').html('request to package number '+id_package+' successfully.');
                    $('.gh').remove();
                }else{
                    _this.html('Request');
                    _this.attr('disabled', false);
                    alert('system error');
                }
            })
        });
    </script>
@endpush --}}

@extends('layouts.mobile',['page' => __('Request Your Parcel'), 'pageSlug' => 'create-request'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content trip has-btn-footer">
        @include('alerts.error')
        {!! Form::open([ 'route' => ['trip.request.save'] ,'method' => 'post']) !!}
            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
            <input type="hidden" name="user_id" value="{{ $trip->user_id }}">

            <div class="row no-gutters">
                <div class="form-group  w-100">
                    <label for="size_package">Package (kg)</label>
                    {!! Form::number('size', null, ['id' => 'size', 'required','class' => (($errors->has("size"))?"is-invalid ":"") . 'form-control', 'placeholder' => 'Package size', 'autocomplete' => "off"]) !!}
                    <span class="separator"></span>
                    @error('size')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row no-gutters">
                <div class="form-group form-group-custom w-100">
                    <label for="description">Description</label>
                    {!! Form::textarea('description', null, ['class'=> 'w-100 p-0', 'rows' => 5]) !!}
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row no-gutters">
                <div class="col-12">
                    <button class="btn btn-pixen bg-pixen w-100 mt-4" type="submit">Request</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<!-- end main content -->
@endsection
@push('css')
    <link  rel="stylesheet" href="{{ asset('css/autocomplete_country.css') }}">
@endpush