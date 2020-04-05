@extends('layouts.mobile',['page' => __('Change Password'), 'pageSlug' => 'profile'])

@section('content')
<!-- start content -->

<div class="container-fluid profile content has-btn-footer">

    @include('alerts.error')
    @include('alerts.success')
    <div class="row no-gutters">
        {!! Form::open(['route' => 'update.password' ,'method' => 'post', 'class' => 'w-100 container-fluid' , 'id' => 'profile_form']) !!}
    
        <div class="form-group">
            <label for="input-pw">{{ __('Password') }}</label>
            <input type="password" class="form-control  @error('current_password') is-invalid @enderror" name="current_password" id="input-pw" placeholder="*********"required>
            <span class="separator"></span>
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="input-npw">{{ __('New Password') }}</label>
            <input type="password" class="form-control  @error('new_password') is-invalid @enderror" name="new_password" id="input-npw" placeholder="*********" required>
            <span class="separator"></span>
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="input-cp">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control  @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" id="input-cp" placeholder="*********" required>
            <span class="separator"></span>
            @error('new_confirm_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <div class="row no-gutters">
                <div class="col-12">
                    <button class="btn btn-pixen bg-pixen w-100 mt-4" type="submit">Save</button>
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
