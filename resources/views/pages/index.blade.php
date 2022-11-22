<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
    <ul id = "info" class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{ route('faq') }}">FAQ</a></li>
      <li><a href="{{ route('about') }}">About</a></li>
      <li><a href="{{ route('contacts') }}">Contacts</a></li>
    </ul>

  <div class="col-md-3 text-end">
    <button class="btn btn-outline-dark"><a href="{{ route('login') }}">LOGIN</a></button>
  </div>

<!-- <header>
  <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
</header>
<nav id = "info">
  <a href="{{ route('faq') }}">FAQ</a>
  <a href="{{ route('about') }}">About</a>
  <a href="{{ route('contacts') }}">Contacts</a>
</nav>
<button class="btn btn-outline-dark acceptInviteButton"><a href="{{ route('login') }}">LOGIN</a></button> -->


  <div class="p-5 text-center bg-image">
    <img src="{{ URL::to('/images/background.png') }}" class= "background">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="text-white">
        <!-- <h4 class="mb-3">Subheading</h4> -->
      </div>
    </div>
  </div>
</header>

<div class="footer container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>

      <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Contacts</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
      </ul>
    </footer>
</div>
