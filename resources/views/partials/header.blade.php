<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<script src={{ asset('js/ajax.js') }} defer></script>
<script src={{ asset('js/search.js') }} defer></script>
<script src={{ asset('js/notification.js') }} defer></script>
@section('header')
  <div class="row justify-content-between headerContainer" id="headerContainer">
    <div class="col-4">
      <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" alt="LBAW logo" class= "logo"></a>
    </div>
    <div class="col-4">
      <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="searchbar">
      <section>
            @include('pages.search')
            @yield('search')
      </section>
    </div>
    <div class="col-4 btn-toolbar allButtons text-right">
      <div class = "btn-group" role = "group">
        <button type = "button" class = "btn btn-secondary btn-light rounded" id = "sideNavButton"><i class="bi bi-list"></i></button>
      </div>
      <div class = "btn-group" role = "group">
        <button type = "button" class = "btn btn-secondary btn-light rounded" ><a href = "{{route('profile')}}" class = "link" ><i class="bi bi-person"></i></a></button>
      </div>
      <div class = "btn-group" role = "group">
        <button class="btn btn-secondary btn-light rounded" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-bell" ></i></button>
        <section id = 'notifications'>
          @include('partials.notifications')
          @yield('notifications')
        </section>
      </div> 
      <div class = "btn-group" role = "group">
        <button type = "button" class = "btn btn-secondary btn-light rounded" ><a href = "{{route('logout')}}" class = "link"><i class="bi bi-box-arrow-right"></i></a></button>
      </div>
    </div>
  </div>
  @endsection


  
