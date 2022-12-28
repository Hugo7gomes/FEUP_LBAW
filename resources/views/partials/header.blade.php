<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<script src={{ asset('js/ajax.js') }} defer></script>
<script src={{ asset('js/search.js') }} defer></script>
<script src={{ asset('js/notification.js') }} defer></script>
@section('header')
  <div class="headerContainer" id="headerContainer">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="searchbar">
        <div class = "btn-toolbar allButtons" role="toolbar">
          <div class = "btn-group mr-5" role = "group">
            <button type = "button" class = "btn btn-secondary btn-light rounded" ><a href = "{{route('profile')}}" class = "link" ><i class="bi bi-person"></i></a></button>
          </div>
          <div class = "btn-group mr-5" role = "group">
            <button class="btn btn-secondary btn-light rounded" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-bell" ></i></button>
            <section id = 'notifications'>
              @include('partials.notifications')
              @yield('notifications')
            </section>
          </div> 
          <div class = "btn-group mr-5" role = "group">
            <button type = "button" class = "btn btn-secondary btn-light rounded" ><a href = "{{route('logout')}}" class = "link"><i class="bi bi-box-arrow-right"></i></a></button>
          </div>
        </div>
      </div>
  </div>
  @endsection


  
