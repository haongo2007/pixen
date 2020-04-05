@extends('layouts.mobile',['page' => __('Post Your Parcel'), 'pageSlug' => 'package-create'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content trip has-btn-footer">
        @include('alerts.error')
        {!! Form::open(['id' => 'package_form']) !!}

            <div class="row no-gutters">
                <div class="form-group w-100">
                    <label for="begin_place">From</label>
                    {!! Form::text('begin_place', null, ['id' => 'begin_place', 'required','class' => 'form-control', 'placeholder' => 'Please enter the name of the airport', 'autocomplete' => "off"]) !!}
                    <span class="separator"></span>
                    <span class="invalid-feedback begin_place " role="alert">
                        <strong></strong>
                    </span>
                    
                </div>
            </div>

            <div class="row no-gutters">
                <div class="form-group w-100">
                    <label for="arrival_place">To</label>
                    {!! Form::text('arrival_place', null, ['id' => 'arrival_place', 'required','class' => 'form-control', 'placeholder' => 'Please enter the name of the airport', 'autocomplete' => "off"]) !!}
                    <span class="separator"></span>
                    <span class="invalid-feedback arrival_place " role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="form-group w-100">
                    <label for="begin_time">Begin time</label>
                    {!! Form::text('begin_time', null, ['id' => 'begin_time', 'required','class' => 'form-control single-date', 'placeholder' => 'Date', 'autocomplete' => "off", 'readonly']) !!}
                    <span class="separator"></span>
                    <span class="invalid-feedback begin_time " role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="form-group w-100">
                    <label for="arrival_time">Arrival time</label>
                    {!! Form::text('arrival_time', null, ['id' => 'arrival_time', 'required','class' => 'form-control single-date', 'placeholder' => 'Date', 'autocomplete' => "off", 'readonly']) !!}
                    <span class="separator"></span>
                    <span class="invalid-feedback arrival_time " role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="form-group  w-100">
                    <label for="size_package">Package (kg)</label>
                    {!! Form::number('size', null, ['id' => 'size', 'required','class' => 'form-control', 'placeholder' => 'Size Package', 'autocomplete' => "off"]) !!}
                    <span class="separator"></span>
                    <span class="invalid-feedback  size" role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="form-group form-group-custom w-100">
                    <label for="description">Description</label>
                    {!! Form::textarea('description', null, ['class'=> 'w-100 p-0', 'rows' => 5]) !!}
                    <span class="invalid-feedback  description" role="alert">
                        <strong></strong>
                    </span>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-12">
                    <button class="btn btn-primary btn-pixen bg-pixen w-100 mt-4 submit">
                        Post
                    </button>
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

@push('js')
    <script src="{{ asset('js/autocomplete_country.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            
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

            $('#begin_place').on('keyup',handleClick);

            $('#arrival_place').on('keyup',handleClick);

            $("#begin_time").click(function () {
                $(".show-calendar").css('left', '25%');
            });

        });
        $('.submit').click(function(event) {
            event.preventDefault();
            var _this = $(this);
            var begin_place = $( "input[name='begin_place']" ).attr('data-id');
            var arrival_place = $( "input[name='arrival_place']" ).attr('data-id');
            var begin_time = $( "input[name='begin_time']" ).val();
            var arrival_time = $( "input[name='arrival_time']" ).val();
            var size = $( "input[name='size']" ).val();
            var description = $( "textarea[name='description']" ).val();
            var token = '{{ csrf_token() }}';
            if (!begin_place) {
                $( "input[name='begin_place']" ).addClass('is-invalid');
                $( ".begin_place" ).find('strong').html('Invalid From field please use our data');
                $( ".begin_place" ).addClass('invalid-feedback').removeClass('is-invalid-feedback');
                return false;
            }else{
                $( "input[name='begin_place']" ).removeClass('is-invalid');
                $( ".begin_place" ).find('strong').html('');
                $( ".begin_place" ).addClass('is-invalid-feedback').removeClass('invalid-feedback');
            }

            if (!arrival_place) {
                $( "input[name='arrival_place']" ).addClass('is-invalid');
                $( ".arrival_place" ).find('strong').html('Invalid To field please use our data');
                $( ".arrival_place" ).addClass('invalid-feedback').removeClass('is-invalid-feedback');
                return false;
            }else{
                $( "input[name='arrival_place']" ).removeClass('is-invalid');
                $( ".arrival_place" ).nextAll('.invalid-feedback').find('strong').html('');
                $( ".arrival_place" ).nextAll('.invalid-feedback').addClass('is-invalid-feedback').removeClass('invalid-feedback');
            }
            _this.attr('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Loading..');
            var data = {_token:token,begin_place: begin_place,arrival_place: arrival_place,begin_time: begin_time,arrival_time: arrival_time,size:size,description:description};
            $.ajax({
                url: '{{ route('package.store') }}',
                type: 'POST',
                data: data,
            })
            .done(function(data) {
                if($.isEmptyObject(data.error)){
                    window.location.assign("{{ route('search') }}")
                }else{
                    _this.removeAttr('disabled').html('Post');
                    $.each(data.error, function(index, val) {
                        $('.'+index).prevAll("input[name='"+index+"']").addClass('is-invalid');
                        $('.'+index).find('strong').html(val);
                    });
                }
            })
            
        });
    </script>
@endpush
