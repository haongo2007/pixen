<div class="trip__card row no-gutters p-2">
    <div class="lf">
        <img src="{{ asset($cm->user->avatarImage()) }}" alt="">
        <div class="t d-flex align-items-center">
            <b>{{ $cm->user->getName() }}</b><br>
        </div>
    </div>
    <span>{{ \Carbon\Carbon::parse($cm->created_at)->diffForHumans() }}</span>
    {{-- <div class="dropdown">
        <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item edit_cm" href="javascript:void(0)" id="{{ $value->id }}">{{ __('Edit') }}</a>
            <a class="dropdown-item dele_cm" href="javascript:void(0)" id="{{ $value->id }}">{{ __('Delete') }}</a>
        </div>
    </div> --}}
    <div class="d-flex w-100">
        <p class="mb-0 w-100 box-mess mr-4" contenteditable="false">{{ $cm->message }}</p>
        <img src="{{ asset('images/icon/next.svg') }}" width="20" alt="" class="d-none send_ed">
    </div>
    <i class="fa fa-times dele_cm cursor" aria-hidden="true" id="{{ $cm->id }}"></i>
</div>