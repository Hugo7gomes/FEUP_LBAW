@if($comment !== null)
    <div class="d-flex flex-start">
        <img class="rounded-circle shadow-1-strong me-3"
            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp" alt="avatar" width="60"
            height="60" />
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