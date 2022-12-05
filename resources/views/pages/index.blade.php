<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="{{ asset('css/index.css') }}" rel="stylesheet">




<body>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
  <div id="headerInfo">
    <div id="faq"><a href="{{ route('faq') }}">FAQ</a></div>
    <div id="about"><a href="{{ route('about') }}">About</a></div>
    <div id="contacts"><a href="{{ route('contacts') }}">Contacts</a></div>
  </div>
  @if (!Auth::check())
  <div class="col-md-3 text-end">
    <button class="loginButton"><a id="loginButton" href="{{ route('login') }}">LOGIN</a></button>
  </div>
  @else
  <div class="col-md-3 text-end">
    <button class="profileButton"><a id="profileButton" href="{{ route('profile') }}">PROFILE</a></button>
  </div>
  @endif
</header>

<main>
  <div class="p-5 text-center bg-image">
    <img src="{{ URL::to('/images/background.png') }}" id= "background">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="text-white">
      </div>
    </div>
  </div>
</main>
</body>

