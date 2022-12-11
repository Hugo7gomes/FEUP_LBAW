<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<script src={{ asset('js/ajax.js') }} defer></script>
<script src={{ asset('js/notification.js') }} defer></script>
<script src={{ asset('js/search.js') }} defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
@section('header')
  <div class="headerContainer" id="headerContainer">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
        <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="searchbar">
        <div id = "searchResults">
          <h2 id = "projectsTitleSearch" style="display: none;">Projects</h2>
          <div id = "projectsSearch"></div>
          <h2 id = "tasksTitleSearch" style="display: none;">Tasks</h2>
          <div id = "tasksSearch"></div>
        </div>
        <div class = "btn-toolbar allButtons" role="toolbar">
          <div class = "btn-group mr-5" role = "group">
            <button type = "button" class = "btn btn-secondary btn-light rounded" ><a href = "{{route('profile')}}" class = "link" ><i class="bi bi-person"></i></a></button>
          </div>
          <div class = "btn-group mr-5" role = "group">
            <button type = "button" class = "btn btn-secondary btn-light rounded" id="notificationButton" ><i class="bi bi-bell" ></i></button>
          </div> 
          <div class = "btn-group mr-5" role = "group">
            <button type = "button" class = "btn btn-secondary btn-light rounded" ><a href = "{{route('logout')}}" class = "link"><i class="bi bi-box-arrow-right"></i></a></button>
          </div>
        </div>
      </div>
  </div>
  @endsection
