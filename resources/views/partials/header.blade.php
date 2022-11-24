<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<script src={{ asset('js/ajax.js') }} defer></script>
<script src={{ asset('js/notification.js') }} defer></script>
<script src={{ asset('js/search.js') }} defer></script>
<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
@section('header')
  <div class="headerContainer" id="headerContainer">
    <header>
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
        <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="searchbar">
        <div id = "searchResults">
          <h2 id = "projectsTitleSearch" style="display: none;">Projects</h2>
          <div id = "projectsSearch"></div>
          <h2 id = "tasksTitleSearch" style="display: none;">Tasks</h2>
          <div id = "tasksSearch"></div>
        </div>
        <a href = "{{route('profile')}}"><button class="profileButton"><i class="bi bi-person"></i></button></a>
        <div class="dropdown">
          <button class=" notificationButton"><i class="bi bi-bell" id="notificationButton"></i></button>
          <div class = "dropdown-menu notifications container">
            @if(isset($notifications) && count($notifications)> 0)
              @foreach ($notifications as $notification)
              <div class="row">
                @if($notification->type != 'Invite')
                  <div class ="col" style="width: 18rem;" id = {{$notification->id}}>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <span class="text">{{$notification->text()}}</span>
                        <i class="deleteNot bi bi-x"></i>                        
                      </li>
                    </ul>
                  </div>
                @elseif($notification->type == 'Invite')
                <div class ="col" style="width: 18rem;" id = {{$notification->id}}>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <span class="text">{{$notification->text()}}</span>
                        <div class="buttonsInvite">
                          <form method = "POST" action ="{{ route('project/acceptInvite',['id_project' => $notification->id_project]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark acceptInviteButton">Accept</button>
                          </form>
                          <form method = "POST" action ="{{ route('project/rejectInvite',['id_project' => $notification->id_project]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark acceptInviteButton">Reject</button>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </div>
                @endif
                </div>
              @endforeach
            @else
                <div class ="col" style="width: 18rem;">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <span class="text">Notifications empty aqui</span>
                    </li>
                  </ul>
                </div>
            @endif
          </div>
        </div> 
        <a href = "{{route('logout')}}"><button class="logoutButton"><i class="bi bi-box-arrow-right"></i></button></a>
      </div>
    </header>
  </div>
  @endsection
