
<!-- navbar -->
<div class="navbar {{ (isset($nav_color)) ? $nav_color : '' }}">
    @php 
        $arr_slug_show_bar = ['pixen','my_pixen','notifications','setting','home','payment'];
    @endphp
    @if(in_array($pageSlug, $arr_slug_show_bar) )
        <a href="#" class="navbar-name open-nav">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
    @else
        @if(!isset($back))
            <a href="{{ (isset($redirect_link)) ? $redirect_link : URL::previous() }}" class="navbar-name">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
        @endif
    @endif
    @auth
        @if(Request::segment(1) == 'search')
            <div class="navbar-search w-0 position-relative">
                <input type="text" class="form-control searching" id="basic-url" aria-describedby="basic-addon3" name="searching" autocomplete="off">
            </div>
            <div class="navbar-tools bg-pixen mb-0">
                <i class="fa fa-search show" aria-hidden="true"></i>
            </div>
        @endif
    @endauth
</div>
@if(isset($page))
    <div class="logo">
        <h1 class="w-60">{{ $page }}</h1>
    </div>
@else
    
@endif
<div class="navbar-menu">
    <i class="fa fa-times icon-close" aria-hidden="true"></i>

    <div class="menu-row">
        {{-- <a href="{{ route('home') }}" @if ($pageSlug == 'home') class="active " @endif>
            Home
        </a> --}}
        {{-- <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}" @if ($pageSlug == 'profile') class="active " @endif>
            My profile
        </a> --}}
        <a href="{{ route('home') }}" @if ($pageSlug == 'home') class="active " @endif>
            Home
        </a>
        <a href="{{ route('search') }}" @if ($pageSlug == 'pixen') class="active " @endif>
            Pixen
        </a>
        @guest
            <a href="{{ route('login') }}" title="" class="d-contents ">
                <div>Login</div>
            </a>
        @else
            <a href="{{ route('mypixen') }}" @if ($pageSlug == 'my_pixen') class="active " @endif>
                My Pixen
            </a>
            <a href="{{ route('notifications') }}" @if ($pageSlug == 'notifications') class="active " @endif>
                Notifications
            </a>
            <a href="{{ route('payment') }}" @if ($pageSlug == 'payment') class="active " @endif>
                Payment
            </a>
            <a href="{{ route('setting') }}" @if ($pageSlug == 'setting') class="active " @endif>
                More
            </a>
        @endguest
    </div>
</div>
<!-- end navbar -->