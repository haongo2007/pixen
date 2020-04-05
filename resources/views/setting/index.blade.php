@extends('layouts.mobile',['page' => __('Settings'), 'pageSlug' => 'setting'])

@section('content')
<!-- start content -->

<div class="container-fluid profile content has-btn-footer">

    <div class="row no-gutters">
    	<b class="big-title mb-4">Account</b>
    	<div class="setting-input w-100 d-flex">
    		<div class="setting-icon">
    			<i class="fas fa-user"></i>
    		</div>
			<a href="{{ route('profile.edit') }}" title="" class="setting-text has-caret">
	    		<span>{{ __('Edit Profile') }}</span>
	    	</a>
    	</div>
    	<div class="setting-input w-100 mt-4 d-flex">
    		<div class="setting-icon">
    			<i class="fas fa-lock"></i>
    		</div>
    		<a href="{{ route('profile.changepassword') }}" title="" class="setting-text has-caret">
	    		<span>{{ __('Change Password') }}</span>
	    	</a>
    	</div>
    	{{-- <div class="setting-input w-100 mt-4 d-flex">
    		<div class="setting-icon">
    			<i class="fas fa-bell"></i>
	    	</div>
    		<span class="setting-text d-flex justify-content-between">
                {{ __('Notifications') }}
                <div class="custom-switch custom-switch-sm pl-0">
                    <input class="custom-switch-input" id="notification" type="checkbox">
                    <label class="custom-switch-btn" for="notification"></label>
                </div>
            </span>
    	</div>
    	<div class="setting-input w-100 mt-4 d-flex">
    		<div class="setting-icon">
    			<i class="fas fa-hand-paper"></i>
	    	</div>
            <a href="{{ route('update.privacy') }}" title="" class="setting-text has-caret">
        		<span>{{ __('Privacy Settings') }}</span>
            </a>
    	</div> --}}
    	<div class="setting-input w-100 mt-4 d-flex">
    		<div class="setting-icon">
    			<i class="fas fa-sign-out-alt"></i>
	    	</div>
	    	<a class="setting-text has-caret" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	    		<span>{{ __('Sign Out') }}</span>
		    </a>
    	</div>
	    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    	{{-- <b class="big-title mt-4">More Options</b>

        <div class="setting-input w-100 mt-4">
            <span class="setting-text d-flex justify-content-between align-items-center">
                {{ __('Newsletter') }}
                <div class="custom-switch custom-switch-sm pl-0 mb-2">
                    <input class="custom-switch-input" id="newsletter" type="checkbox">
                    <label class="custom-switch-btn" for="newsletter"></label>
                </div>
            </span>
        </div>
        <div class="setting-input w-100 mt-4">
            <span class="setting-text d-flex justify-content-between align-items-center">
                {{ __('Phone Calls') }}
                <div class="custom-switch custom-switch-sm pl-0 mb-2">
                    <input class="custom-switch-input" id="phonecall" type="checkbox">
                    <label class="custom-switch-btn" for="phonecall"></label>
                </div>
            </span>
        </div> --}}
    </div>
</div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/component-custom-switch.min.css') }}">
@endpush
