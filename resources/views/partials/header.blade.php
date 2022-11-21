<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
@section('header')
  <div class="headerContainer" id="headerContainer">
    <header>
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo">

        <form class="searchbar col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="searchbar">
        </form>
        
        <button class="profileButton"><i class="bi bi-person"></i></button>
        <div class="dropdown">
          <button class="notificationButton"><i class="bi bi-bell" id="notificationButton"></i></button>
          <div class = "dropdown-menu notifications">
            @if(isset($notifications))
              @foreach ($notifications as $notification)
                <span>{{$notification->text()}}</span>
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
                <button class="deleteNot"><i class="bi bi-x-lg"></i></button>
              @endforeach
            @endif
          </div> 
        </div> 
      </div>
    </header>
  </div>
  @endsection

<!-- <button class="fa-regular fa-bell"></button>
<button class="fa-solid fa-user"></button> -->
<!--<button class="fa-regular fa-user"</button>-->