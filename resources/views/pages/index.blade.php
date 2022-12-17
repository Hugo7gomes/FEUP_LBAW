<!DOCTYPE html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
  <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>
<body>
  <header>
    <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
    <div id="headerInfo">
      <div id="faq"><a href="{{ route('faq') }}">FAQ</a></div>
      <div id="about"><a href="{{ route('about') }}">About</a></div>
      <div id="contacts"><a href="{{ route('contacts') }}">Contacts</a></div>
    </div>
    <div class="col-md-3 text-end">
      <button class="btn btn-outline-dark btn-lg"><a id="loginButton" href="{{ route('login') }}">LOGIN</a></button>
    </div>
  </header>
</body>

