@extends('layouts.mobile',['pageSlug' => 'choose'])

@section('content')
    <!-- start content -->
    <div class="container-fluid content modal_choose has-btn-footer">
        <div class="title text-center">You're looking for...</div>
        <a href="{{ route('home.search.traveler') }}">
            <div class="card">
                <img src="{{ asset('images/person.png') }}" alt="traveler">
                <div class="card-name">
                    traveler
                </div>
            </div>
        </a>
        <a href="{{ route('search.package') }}">
            <div class="card">
                <img src="{{ asset('images/boxes.svg') }}" alt="package">
                <div class="card-name">
                    package
                </div>
            </div>
        </a>
    </div>
@endsection
