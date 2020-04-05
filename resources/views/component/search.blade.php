<div class="tab-pane fade {{ (session('pickup')) ? session('pickup').' show' : '' }} {{ (!session('send') && !session('pickup')) ? 'active show' : '' }}" id="pickup" role="tabpanel" aria-labelledby="waiting-tab">
    @foreach($trips as $key => $value)
        <a href="{{ route('trip.show',['id' => $value->id]) }}" title="">
            <div class="ps-1">
                <div class="image">
                    <img src="{{ asset($value->hasOneUser->avatarImage()) }}" alt="">
                    <div class="c-rq">
                        <span>
                            {{ $value->count_request() }} Requests<br>
                        </span>
                    </div>
                </div>
                <div class="ctent">
                    <h6>{{ $value->hasOneUser->getname() }}</h6>
                    <p>From <span>{{ $value->hasOne_begin_place->name }}</span></p>
                    <p>To <span>{{ $value->hasOne_arrival_place->name }}</span></p>
                    <p>{{ \Carbon\Carbon::parse($value->begin_time)->calendar() }} -> {{ \Carbon\Carbon::parse($value->arrival_time)->calendar() }}</p>
                </div>
            </div>
        </a>
    @endforeach
    @if(Auth::user())
        <div class="wrp-btn">
            <a href="{{ route('trip.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100">Post Your Trip</button></a>
        </div>
    @endif
</div>
<div class="tab-pane fade {{ (session('send')) ? session('send').' show' : '' }}" id="send" role="tabpanel" aria-labelledby="completed-tab">
    @foreach($packages as $key => $value)
        <a href="{{ route('package.show',['id' => $value->id]) }}" title="">
            <div class="ps-1">
                <div class="image">
                    <img src="{{ asset($value->hasOneUser->avatarImage()) }}" alt="">
                    <div class="c-rq">
                        <span>
                            {{ $value->count_request() }} Requests <br>
                        </span>
                    </div>
                </div>
                <div class="ctent">
                    <h6>{{ $value->hasOneUser->getname() }}</h6>
                    <p>From <span>{{ $value->hasOne_begin_place->name }}</span></p>
                    <p>To <span>{{ $value->hasOne_arrival_place->name }}</span></p>
                    <p>{{ \Carbon\Carbon::parse($value->begin_time)->calendar() }} -> {{ \Carbon\Carbon::parse($value->arrival_time)->calendar() }}</p>
                </div>
            </div>
        </a>
    @endforeach
    @if(Auth::user())
        <div class="wrp-btn">
            <a href="{{ route('package.create') }}" class="d-contents"><button class="btn btn-pixen bg-pixen w-100">Post Your Parcel</button></a>
        </div>
    @endif
</div>