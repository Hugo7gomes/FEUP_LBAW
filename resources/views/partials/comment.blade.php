@if($comment !== null)
    <div class="d-flex flex-start">
        @if($user->photo != null)
            <img src={{asset($user->photo->path)}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="60" height="60">
        @else
            <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="60" height="60">
        @endif
        <div class="commentInfo">
            <div class="commentText">
                <p class="commentName">{{$comment->owner->name}}</p>
                <p class="mb-0 commentDate">{{$comment->date}}</p>
            </div>
            <p class="mb-0 commentText">{{$comment->comment}}</p>
        </div>
    </div>
<hr class="my-0">
@endif