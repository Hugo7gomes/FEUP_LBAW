<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<script src={{ asset('js/notification.js') }} defer></script>
<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
@section('header')
  <div class="headerContainer" id="headerContainer">
    <header>
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>

        <form class="searchbar col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="searchbar">
        </form>
        
        <a href = "{{route('profile')}}"><button class="profileButton"><i class="bi bi-person"></i></button></a>
        <div class="dropdown">
          <button class="notificationButton"><i class="bi bi-bell" id="notificationButton"></i></button>
          <div class = "dropdown-menu notifications">
            @if(isset($notifications))
              @foreach ($notifications as $notification)
                @if($notification->type != 'Invite')
                  <div class ="card notificationDiv" style="width: 18rem;" id = {{$notification->id}}>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <!-- <div class=""> -->
                          {{$notification->text()}}
                        <i class="deleteNot bi bi-x"></i>
                        <!-- </div> -->
                      </li>
                    </ul>
                  </div>
                @elseif($notification->type == 'Invite')
                  <div class = 'notificationDiv' id = {{$notification->id}}>
                    <span>{{$notification->text()}}</span>
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
      </div>
    </header>
  </div>
  @endsection
