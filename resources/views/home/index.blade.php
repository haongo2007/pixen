@extends('layouts.mobile',['page' => __('Home'), 'pageSlug' => 'home'])

@section('content')
<div class="home">
    <div class="banner container-fluid">
        <svg height="200" width="200" class="circle">
            <circle cx="100" cy="100" r="80" />
        </svg>
        <div class="row banner__1 justify-content-start">
            <div class="text">We deliver</div>
            <img src="{{ asset('images/banner1.png')}}" alt="banner 1">
        </div>
        <div class="row banner__2">
            <img src="{{ asset('images/banner2.png')}}" alt="banner 2">
            <div class="d-flex">
                <div class="text">Emotions</div>
                <img src="{{ asset('images/banner3.png')}}" alt="divanner 3">
            </div>
        </div>
        <div class="row banner__3 flex-wrap">
            <img src="{{ asset('images/banner4.png')}}" alt="banner 4">
            <div class="text-center text w-100">How it works?</div>
        </div>
    </div>
    <div class="how">
        <div class="how__wrap">
            {{-- <img src="{{ asset('images/home_wrap1.png')}}" class="w-100" alt="home_wrap"> --}}
            {{-- <img src="{{ asset('images/home_wrap2.svg') }}" alt="home wrap 2"> --}}
            <div class="slick-container">
                <div class="slick-item slick-1">
                    <img src="{{ asset('images/home1.svg') }}" alt="look for traveler">
                    <div class="text">Look for a traveler and get in touch through our messaging system. Discuss the tip, the possible price of the item (in case of a purchase) and any shipping charges.</div>
                </div>
                <div class="slick-item slick-2">
                    <img src="{{ asset('images/home2.svg') }}" alt="look for traveler">
                    <div class="text">Look for a traveler and get in touch through our messaging system. Discuss the tip, the possible price of the item (in case of a purchase) and any shipping charges.</div>
                </div>
                <div class="slick-item slick-3">
                    <img src="{{ asset('images/home3.svg') }}" alt="look for traveler">
                    <div class="text">Look for a traveler and get in touch through our messaging system. Discuss the tip, the possible price of the item (in case of a purchase) and any shipping charges.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials">
        <div class="title">Testimonials</div>
        <div class="slick-container-tertimonials">
            <div class="slick-card">
                <img src="{{ asset('images/comment.png')}}">
                <div class="slick-card-wrap">
                    <div class="slick-card-top">
                        <div class="slick-card-rates"></div>
                        <div class="slick-card-date">2019<br>08<br>20</div>
                    </div>
                    <div class="slick-card-contents">
                        <div class="yellow">Jame - Advanced</div>
                        <div>Very good communication with Luke,everything went great :)</div>
                        <div>Deliver: A Package</div>
                    </div>
                </div>
            </div>
            <div class="slick-card">
                <img src="{{ asset('images/comment.png')}}">
                <div class="slick-card-wrap">
                    <div class="slick-card-top">
                        <div class="slick-card-rates"></div>
                        <div class="slick-card-date">2019<br>08<br>20</div>
                    </div>
                    <div class="slick-card-contents">
                        <div class="yellow">Jame - Advanced</div>
                        <div>Very good communication with Luke,everything went great :)</div>
                        <div>Deliver: A Package</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="discover">
        <div class="discover__wrap">
            <svg height="200" width="200" class="circle">
                <circle cx="100" cy="100" r="80" />
            </svg>
            <div class="title">Discover with us</div>
            <p class="w-100 text-center mb-0">Bigsend’s aim is to do everything in a smart way, which means turning ordinary, everyday acts into extraordinary ones.</p>
        </div>
    </div>
    <a href="{{ route('search')}}" class="footer">
        <div class="text">START</div>
        <img src="{{ asset('images/icon/arrow_right.png') }}">
    </a>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
            generateStars($('.slick-card-rates'), 4 , '20px' ,true , '' , '#FDC800');
            $('.slick-container').slick({
                infinite : false
            });

            $('.slick-container-tertimonials').slick({
                // infinite:false,
                variableWidth: true
            })
            
        })
    </script>
    @stop
    