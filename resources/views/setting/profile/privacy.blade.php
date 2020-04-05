@extends('layouts.mobile',['page' => __('Privacy Settings'), 'pageSlug' => 'profile'])

@section('content')
<!-- start content -->

<div class="container-fluid profile content has-btn-footer">

    <div class="row no-gutters">

    	<div class="setting-input w-100 mt-4 d-flex">
    		<div class="setting-icon">
    			<i class="fas fa-location-arrow"></i>
	    	</div>
    		<span class="setting-text d-flex justify-content-between">
                {{ __('Location Services') }}
                <div class="custom-switch custom-switch-sm pl-0">
                    <input class="custom-switch-input" id="local" type="checkbox">
                    <label class="custom-switch-btn" for="local"></label>
                </div>
            </span>
    	</div>
        <div class="setting-input w-100 mt-4 d-flex">
            <div class="setting-icon">
                <i class="far fa-image"></i>
            </div>
            <span class="setting-text d-flex justify-content-between">
                {{ __('Photos') }}
                <div class="custom-switch custom-switch-sm pl-0">
                    <input class="custom-switch-input" id="photos" type="checkbox">
                    <label class="custom-switch-btn" for="photos"></label>
                </div>
            </span>
        </div>
        <div class="setting-input w-100 mt-4 d-flex">
            <div class="setting-icon">
                <i class="fas fa-camera"></i>
            </div>
            <span class="setting-text d-flex justify-content-between">
                {{ __('Camera') }}
                <div class="custom-switch custom-switch-sm pl-0">
                    <input class="custom-switch-input" id="camera" type="checkbox">
                    <label class="custom-switch-btn" for="camera"></label>
                </div>
            </span>
        </div>


    </div>
</div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/component-custom-switch.min.css') }}">
@endpush
