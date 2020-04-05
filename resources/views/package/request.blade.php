@extends('layouts.mobile',['page' => __('Post Your Trip'), 'pageSlug' => 'create-request','back'=>'not'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content trip has-btn-footer">
        @include('alerts.error')
        {!! Form::open([ 'route' => ['package.request.save'] ,'method' => 'post']) !!}
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <input type="hidden" name="user_id" value="{{ $package->user_id }}">

            <div class="row no-gutters">
                <div class="form-group  w-100">
                    <label for="size_package">Size (kg)</label>
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
                    <button class="btn btn-pixen bg-pixen w-100 mt-4" type="submit">Post</button>
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