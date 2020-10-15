@extends('layouts.mobile',['page' => __('Edit Profile'), 'pageSlug' => 'profile'])

@section('content')
<!-- start content -->

<div class="container-fluid profile content has-btn-footer">

    @include('alerts.error')
    @include('alerts.success')
    <div class="row no-gutters">
        {!! Form::open(['route' => ['update.profile', Auth::user()->id] ,'method' => 'post', 'class' => 'w-100 container-fluid' , 'enctype' => 'multipart/form-data', 'id' => 'profile_form']) !!}
        <div class="w-100 input-image cropie" a-type="avatar" crop-height="300" crop-width="300" crop-type="circle" crop-url="{{ asset(Auth::user()->avatarImage()) }}">
            <label for="input-id" class="input-id w-100">
                <label for="input-id" class="input-id w-100">
                    <img src="{{ asset(Auth::user()->avatarImage()) }}"
                    class="visible avatar_user">
                </label>
            </label>
            <label for="input-id" class="icon-plus">
                <i class="fas fa-plus"></i>
            </label>
        </div>
        <div class="form-group">
            <label for="input-lastname">{{ __('First name') }}</label>
            <input type="text" class="form-control  @error('fname') is-invalid @enderror" name="fname" id="input-fname" value="{{ Auth::user()->first_name }}" placeholder="Your First Name" value="{{ old('fname') }}" required>
            <span class="separator"></span>
            @error('fname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="input-lastname">{{ __('Last name') }}</label>
            <input type="text" class="form-control  @error('lname') is-invalid @enderror" name="lname" id="input-lname" value="{{ Auth::user()->last_name }}" placeholder="Your Last Name" value="{{ old('lname') }}" required>
            <span class="separator"></span>
            @error('lname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="input-email">{{ __('Email') }}</label>
            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="input-email" value="{{ Auth::user()->email }}" value="{{ old('email') }}" required placeholder="Your Email">
            <span class="separator"></span>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="input-country">{{ __('Country') }}</label>
            <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" id="input-country" 
            @if(Auth::user()->country_id)
                value="{{ Auth::user()->country->name }}"
                data-id="{{ Auth::user()->country->id }}" 
            @endif
            required autocomplete="off" placeholder="Your Country">
            <span class="separator"></span>
            @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="is-invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>

        <div class="form-group">
            <label for="input-phone">{{ __('Mobile phone') }}</label>
            @if(Auth::user()->country)
                
            @endif
            <img src="{{ (Auth::user()->country) ? str_replace('{iso}', Auth::user()->country->iso, Auth::user()->country->flag) : asset('images/icon/default.jpg') }}" alt="flag" class="flag-in-field {{ Auth::user()->country ? '' : 'd-none' }} " width="30px">
            <b class="code_calling">{{ (Auth::user()->country) ? '(+'. Auth::user()->country->phonecode .') ' : '' }}</b>
            <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" id="input-phone" 
            value="{{ Auth::user()->phone }}" value="{{ old('phone') }}" required placeholder="Your Phone Number">
            <span class="separator"></span>
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="input-Birthday">{{ __('Birthday') }}</label>
            <input type="text" readonly class="form-control single-date-not-time @error('birthday') is-invalid @enderror" name="birthday" id="input-birthday" value="{{ (Auth::user()->birthday) ? date('Y/m/d', strtotime(Auth::user()->birthday)) : ''}}" required autocomplete="off" placeholder="Your Birthday">
            <span class="separator"></span>
            @error('birthday')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group form-group-custom border-0">
            <div class="w-100">
                <textarea class="w-100" rows="5" placeholder="Route preferences, leash location, treats given, etc" name="description">{{ (Auth::user()->description) ? Auth::user()->description : 'Description' }}</textarea>
            </div>
        </div>

        <div class="form-group">
            {{-- <label for="input-idcard" class="pl-0 col-12 col-form-label">identity card</label>
            <div class="w-100  input-idcard">
                <label for="input-idcard" class="input-idcard cropie w-100" a-type="identity" crop-height="160" crop-width="300" crop-type="square" crop-url="{{ asset(Auth::user()->idcardImage()) }}">
                    <img src="{{ asset(Auth::user()->idcardImage()) }}"
                    class="visible w-100 idcard_user">
                </label>
            </div> --}}
            <div class="row no-gutters">
                <div class="col-12">
                    <button class="btn btn-pixen bg-pixen w-100 mt-4 submit" type="button">Update</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="myUploadImage">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="upload-demo"></div>
                <input type="file" id="images" name="">    
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-block image-upload" >Upload Image</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<link  rel="stylesheet" href="{{ asset('css/autocomplete_country.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<style type="text/css">
    .invalid-feedback {
        display: block;
    }
</style>
@endpush

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<script src="{{ asset('js/autocomplete_country.js') }}"></script>
<script type="text/javascript">
    $("#input-birthday").click(function () {
        $(".show-calendar").css('left', '25%');
    });

    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: { 
            width: 100,
            height: 100,
            type: 'circle'
        },
        boundary: {
            width: 100,
            height: 100
        }
    });
    
    $('.cropie').click(function(event) {
        $('#myUploadImage').modal('show');
        var type = $(this).attr('a-type');
        $('#myUploadImage').find('#images').attr('name', type);
        var w = $(this).attr('crop-width');
        var h = $(this).attr('crop-height');
        var t = $(this).attr('crop-type');
        var url = $(this).attr('crop-url');
        $('#upload-demo').croppie('destroy');

        var resize = $('#upload-demo').croppie({
            url: url,
            enableExif: true,
            enableOrientation: true,
            viewport: { 
                width: w,
                height: h,
                type: t
            },
            boundary: {
                width: w,
                height: h
            }
        });
    });

    $('#images').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            resize.croppie('bind',{
                url: e.target.result
            }).then(function(){
                console.log('success bind image');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.image-upload').on('click', function (ev) {
        var token = `{{ csrf_token() }}`;
        var type = $('#images').attr('name');
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (img) {
            $.ajax({
                url: "{{route('upload.image.profile')}}",
                type: "POST",
                data: {"image":img,'_token':token,'type':type},
                success: function (data) {
                    if (type == 'avatar') {
                        $(".avatar_user").attr('src', img);
                    }else{
                        $(".idcard_user").attr('src', img);
                    }
                    if (data == '200') {
                        $('#myUploadImage').modal('hide');  
                    }
                }
            });
        });
    });

    var handleClick = debounce(function (e) {
        var val = $(this).val();
        var self = $(this);
        if (val == '') {
            return false;
        }
        $.ajax({
            url:"{{ route('country.autocomplete') }}",
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

    $('#input-country').on('keyup',handleClick);

    $('.submit').click(function(event) {
        event.preventDefault();
        var country_id = $( "input[name='country']" ).attr('data-id');
        if (!country_id) {
            $( "input[name='country']" ).addClass('is-invalid');
            $( "input[name='country']" ).nextAll('.is-invalid-feedback').find('strong').html('Invalid country field please use our data')
            $( "input[name='country']" ).nextAll('.is-invalid-feedback').addClass('invalid-feedback').removeClass('is-invalid-feedback');
            return false;
        }
        $( "input[name='country']" ).val(country_id);

        $('#profile_form').submit();
        
    });
/*    $('#input-country').focus(function(event) {
        var token = `{{ csrf_token() }}`;
        $.ajax({
            url: "https://restcountries.eu/rest/v2/all",
            type: "GET",
            success: function (data) {
                $.each(data, function(index, val) {
                    $.ajax({
                        url: "{{route('crop.image')}}",
                        type: "POST",
                        data: {
                            'link':val.flag,
                            'name': val.name,
                            'name_native': val.nativeName,
                            'code': val.alpha2Code,
                            'time_zones': val.timezones,
                            'calling_codes': val.callingCodes,
                            '_token':token
                            },
                        success: function (data) {
                            console.log('success');
                        }
                    });
                    
                });
            }
        });
    });*/

</script>
@endpush
