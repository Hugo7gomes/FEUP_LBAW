@if($comment !== null)
    <div class="d-flex flex-start">
        @if($user->photo != null)
            <img src={{asset($user->photo->path)}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="60" height="60">
        @else
            <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="60" height="60">
        @endif
        <div>
            <h6 class="fw-bold mb-1"></h6>
            <div class="d-flex align-items-center mb-3">
            <p class="mb-0">{{$comment->date}}</p>
            </div>
            <p class="mb-0">{{$comment->comment}}</p>
        </div>
    </div>
<hr class="my-0">
@endif