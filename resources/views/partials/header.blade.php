<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

@section('header')
  <div class="headerContainer">
    <header>
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        {{-- meter nosso logo --}}

        <form class="searchbar col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
        </div>
        <div class = "notifications">
          @if(isset($notifications))
            @foreach ($notifications as $notification)
              <h1>{{$notification->text()}}</h1>
              @if($notification->type == 'Invite')
                <div>
                  <form method = "POST" action ="{{ route('project/acceptInvite',['id_project' => $notification->id_project]) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark acceptInviteButton">Accept</button>
                  </form>
                  <form method = "POST" action ="{{ route('project/rejectInvite',['id_project' => $notification->id_project]) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark acceptInviteButton">Reject</button>
                  </form>
                </div>
              @endif
            @endforeach
          @endif
        </div>  
      </div>
    </header>
  </div>
  @endsection