@extends('layouts.mobile',['page' => __('Profile'), 'pageSlug' => 'profile'])

@section('content')
    <!-- start content -->
    <div class="container-fluid profile traveler_info content has-btn-footer">
        <div class="row title-wrap  no-gutters">
            <div class="col-12">
                <div class="title">{{ $user->getName() }}</div>
            </div>
        </div>
        <div class="row sub">
            <div>Begin account <a class="" href="{{ route('home.intro') }}"><u class="font-italic yellow">What it is?</u></a></div>
        </div>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="info-tab" data-toggle="pill" href="#info" role="tab" aria-controls="info" aria-selected="false">Requirement info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="feedback-tab" data-toggle="pill" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Feedback</a>
            </li>
        </ul>
        <div class="tab-content container-fluid p-0" id="pills-tabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row no-gutters">
                    <form class="w-100 container-fluid">
                        <div class="form-group row">
                            <label for="input-email" class="pl-0 col-4 col-form-label">Email</label>
                            <div class="col-6">
                                <input type="text" readonly class="form-control-plaintext" id="input-email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-phone" class="pl-0 col-4 col-form-label">Mobile phone</label>
                            <div class="col-8 d-flex align-items-center">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-birthday" class="pl-0 col-4 col-form-label">Birthday</label>
                            <div class="col-8">
                                <input type="text" readonly class="form-control-plaintext" id="input-birthday" value="{{ date('Y/m/d', strtotime($user->birthday)) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-country" class="pl-0 col-4 col-form-label">Country</label>
                            <div class="col-8 d-flex align-items-center">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $user->country }}">
                            </div>
                        </div>
                        <div class="form-group row flex-wrap form-group-custom border-0">
                            <label for="input-id" class="pl-0 col-12 col-form-label">Identify card</label>
                            <img src="{{ asset($user->idcardImage()) }}" width="" height="162" class="w-100" alt="id">
                        </div>
                        <div class="form-group row flex-wrap form-group-custom border-0">
                            <label for="input-email" class="pl-0 col-12 col-form-label">Avatar</label>
                            <div class="w-100  input-image">
                                <label for="input-avatar" class="input-avatar w-100">
                                    <img src="{{ asset($user->avatarImage()) }}" class="visible">
                                </label>
                            </div>
                        </div>
                        <div class="form-group row flex-wrap form-group-custom border-0">
                            <label for="input-email" class="pl-0 col-12 col-form-label">Bio and description</label>
                            <div class="w-100">
                                <textarea disabled class="w-100" rows="5" placeholder="Route preferences, leash location, treats given, etc">{{ $user->description }}</textarea>
                            </div>
                        </div>
                        @if(Auth::check() && Auth::user()->id == $user->id)
                            <a href="{{ route('profile.edit') }}" title=""><button class="btn btn-black m-auto" type="button">Update Profile</button></a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="i-tab">
                <select class="form-control mb-3 select-info">
                    <option value="0">The trip</option>
                    <option value="1">The package</option>
                </select>
                <div class="info__trip" data-info="0">
                    <div class="search__cards">
                        @foreach($user->hasManyTrips as $key => $value)
                            <div class="search__card" data="trips"  id="{{ $value->id }}">
                                <div class="col-4 col-left">
                                    <div class="search__card-name">{{ $value->user->getName() }}</div>
                                    <div class="search__card-date">Joined: {{ $value->user->created_at }}}</div>
                                    <img  src="{{ asset($value->user->avatarImage()) }}" alt="user" class="search__card-img">
                                    <div class="search__card-date">Online <br> Begin</div>
                                </div>
                                <div class="col-8 col-right">
                                    <div class="text-right mb-3">
                                        <div>Expired date: {{ $value->arrival_time }}</div>
                                        <div class="red"></div>
                                    </div>
                                    <div class="location">
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value->begin_place }}</div>
                                        </div>
                                        <div class="h-100 w-100 p-2 d-flex align-items-center">
                                            <div class="line"></div>
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value->arrival_place }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade modal-detail modalTravelDetail_trips{{ $value->id }}">
                                <input type="hidden" name="id" value="{{ $value['id'] }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="close-icon">x</div>
                                        <div class="d-flex justify-content-between">
                                            <div class="name">{{ $value->user->getName() }}</div>
                                            <div class="rates"></div>
                                        </div>
                                        <img src="{{ asset($value->user->avatarImage()) }}" alt="avatar" height="78" class="col-4 p-0">
                                        <div class="person_info">
                                            <div class="person_info-wrap">
                                                <div><span>Joined: </span>{{ $value->user->created_at }}</div>
                                                <div><span>Hometown: </span>{{ $value->user->country }}</div>
                                                <div><span>Quick contact: </span>{{ $value->quick_contact }}</div>
                                            </div>
                                        </div>
                                        <div class="travel_info">
                                            <p class="title">travel information</p>
                                            <div class="col-12 mb-3">
                                                <div class=""><span>From: </span> {{ $value->begin_place }}</div>
                                                <div class=""><span>To: </span> {{ $value->arrival_place }}</div>
                                                <div class=""><span>Description: </span> {{ $value->description }}</div>
                                                <div class="posted"><span>Posted at: </span> {{ $value->created_at }}</div>
                                            </div>
                                        </div>
                                        @if(Auth::check() && Auth::user()->id != $value->user->id)
                                            <a class="d-contents" href="{{ route('trip.request', ['id' => $value->id]) }}">
                                                <button class="btn btn-black submit">Transport request</button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="info__package search_package" style="display: none;" data-info="1">
                    <div class="search__cards">
                        @foreach($user->hasManyPackage as $key => $value)
                            <div class="search__card" data="package" id="{{ $value->id }}">
                                <div class="col-5 col-left">
                                    <div class="title">{{ $value->hasOneUser->getName() }}</div>
                                    <img src="{{ asset($value->hasOneUser->avatarImage()) }}" alt="item" height="83" class="w-100 round">
                                </div>
                                <div class="col-7 col-right pb-2">
                                    <div class="title">Package transport info</div>
                                    <div class="sub">{{ $value->name }} - <span>{{ $value->size }}</span></div>
                                    <div class="location">
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value->begin_place }}</div>
                                        </div>
                                        <div class="h-100 w-100 d-flex align-items-center" style="padding-left: 1.5px;">
                                            <img src="{{ asset('images') }}/icon/arrow_down.png">
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>{{ $value->arrival_place }}</div>
                                        </div>
                                    </div>
                                    <div class="bubble-wrap">
                                        <img src="{{ asset('images') }}/icon/bubble.png" alt="message">
                                        <div class="">...</div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade modal-detail modalTravelDetail_package{{ $value['id'] }}">
                                <input type="hidden" name="id" value="{{ $value['id'] }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="close-icon">x</div>
                                        <div class="d-flex justify-content-between">
                                            <div class="name">{{ $value->hasOneUser->getName() }}</div>
                                            <div class="rates"></div>
                                        </div>
                                        <img src="{{ asset($value->hasOneUser->avatarImage()) }}" alt="avatar" height="78" class="col-4 p-0">
                                        <div class="person_info">
                                            <div class="person_info-wrap">
                                                <div><span>Joined: </span>{{ $value->hasOneUser->created_at }}</div>
                                                <div><span>Hometown: </span>{{ $value->hasOneUser->country }}</div>
                                                <div><span>Quick contact: </span>{{ $value->quick_contact }}</div>
                                            </div>
                                        </div>
                                        <div class="travel_info">
                                            <p class="title">travel information</p>
                                            <div class="col-12 mb-3">
                                                <div class=""><span>From: </span> {{ $value->begin_place }}</div>
                                                <div class=""><span>To: </span> {{ $value->arrival_place }}</div>
                                                <div class=""><span>Description: </span> {{ $value->description }}</div>
                                                <div class="posted"><span>Posted at: </span> {{ $value->created_at }}</div>
                                            </div>
                                        </div>
                                        @if(Auth::check() && Auth::user()->id != $value->hasOneUser->id)
                                        <a class="d-contents" href="{{ route('package.request',['id' => $value['id']]) }}" title="">
                                            <button class="btn btn-black submit">Package request</button>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade feedback" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <div class="row feedback__blocks">
                    <div class="col-12">
                        @foreach($user->feedbacks as $item)
                        <div class="feedback__wrap d-flex flex-wrap">
                            <div class="feedback__left col-9 pr-0">
                                <a href="{{ route('user.show', ['id' => $item->userFeedback->id]) }}">
                                    <img src="{{ asset($item->userFeedback->avatarImage()) }}" alt="user">
                                </a>
                                <div class="feedback__left-desc w-100">
                                    <div class="desc--rate" id="item_rate_{{ $item->id }}"></div>
                                    <div class="rate">
                                        <div class="d-flex user">
                                            <p>
                                                <a href="{{ route('user.show', ['id' => $item->userFeedback->id]) }}">{{ $item->userFeedback->getName() }}</a>
                                            </p>
                                            <span class="text-truncate">{{ $item->title }}</span>
                                        </div>
                                        <div class="feedback__desc">
                                            {{ $item->description }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="feedback__right col-3">
                                <small class="time">{{ date('j M, Y', strtotime($item->created_at)) }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            @foreach($user->feedbacks as $item)
            generateStars($('#item_rate_{{ $item->id }}'),{{ $item->rating }});
            @endforeach

            //open modal detail
            $('body').on('click','.search__card',function(){
                var part = $(this).attr('data');
                var id = $(this).attr('id');
                $('.modalTravelDetail_'+part+id).modal('show');
            });

            //toggle info when click selectbox
            $('.select-info').on('change',function(){
                $('div[data-info]').not($('div[data-info="' + $(this).val() + '"]')).hide();
                $('div[data-info="' + $(this).val() + '"]').show();
            });
        })
    </script>
@endpush
{{-- 

    <div class="step_2" style="display: none;">
    <div class="form-group">
        <label for="input-lastname">{{ __('First Name') }}</label>
        <input type="text" class="form-control  @error('fname') is-invalid @enderror" name="fname" id="input-firstname" aria-describedby="" placeholder="smith" value="{{ old('fname') }}" required>
        <span class="separator"></span>
        @error('fname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="invalid-feedback" role="alert">
            <strong>Please enter First Name</strong>
        </span>
    </div>
    <div class="form-group">
        <label for="input-lastname">{{ __('Last Name') }}</label>
        <input type="text" class="form-control  @error('lname') is-invalid @enderror" name="lname" id="input-lastname" aria-describedby="" placeholder="john" value="{{ old('lname') }}" required>
        <span class="separator"></span>
        @error('lname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="invalid-feedback" role="alert">
            <strong>Please enter Last Name</strong>
        </span>
    </div>

    <div class="form-group">
        <label for="input-lastname">{{ __('Phone') }}</label>
        <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone" id="input-phone" aria-describedby="" placeholder="john" value="{{ old('phone') }}" required>
        <span class="separator"></span>
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="invalid-feedback" role="alert">
            <strong>Please enter Phone</strong>
        </span>
    </div>

    <div class="form-group">
        <label for="input-lastname">{{ __('Country') }}</label>
        <input type="text" class="form-control  @error('country') is-invalid @enderror" name="country" id="input-country" aria-describedby="" placeholder="john" value="{{ old('country') }}" required>
        <span class="separator"></span>
        @error('country')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="invalid-feedback" role="alert">
            <strong>Please enter country</strong>
        </span>
    </div>

    <div class="form-group">
        <label for="input-birthday">{{ __('Birthday') }}</label>
        <input name="birthday" class="form-control single-date @error('birthday') is-invalid @enderror" value="{{ old('birthday') }}" id="input-birthday" aria-describedby="" autocomplete="off" placeholder="2019/04/21" required>
        <span class="separator"></span>
        @error('birthday')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="invalid-feedback" role="alert">
            <strong>Please enter birthday</strong>
        </span>
    </div>
    <div class="form-group input-image">
        <label>{{ __('Identify Card') }}</label>
        <img src="{{ asset('images/image_placeholder.jpg') }}" class="visible" width="">
        <input type="file" class="form-control d-none @error('idc') is-invalid @enderror" name="idc" value="{{ old('idc') }}" id="input-id" required>
        <label class="input-id" for="input-id" name="input-id">
            Choose file
        </label>
        @error('idc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <span class="invalid-feedback" role="alert">
            <strong>Please update your ID image</strong>
        </span>
    </div>

</div>
 --}}