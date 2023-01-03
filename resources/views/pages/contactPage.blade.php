@auth
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>Contacts</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <header>
      @include('partials.header')
      @yield('header')
    </header>
    <main>
        <h1>Contact Us</h1>
        <p>Got a question or suggestion? We'd love to hear from you!</p>
        <p>
            This web app was created by four third year students from class 8 and group 1 of computer engineering and computing at Feup.
        </p>
        <ul>
            <li>Hugo Gomes</li>
            <li>João Araújo</li>
            <li>João Moreira</li>
            <li>Lia Vieira</li>
            <li>You cand find our project here <a href="https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/wikis/home"> Workfluido</a> </li>
        </ul>
    </main>
    </body>
  <footer class="footer container" id = "footerEnd">
    @include('partials.footer')
    @yield('footer') 
  </footer>
</html>
@endauth
@guest
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Contacts</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" alt="LBAW logo" class= "logo"></a>
            <div id="headerInfo">
                <div id="faqs"><a href="{{ route('faq') }}">FAQ</a></div>
                <div id="about"><a href="{{ route('about') }}">About</a></div>
            </div>
        </header>
        <main>
            <div class="contactInfo">
                <h1>Contact Us</h1>
                <p>Got a question or suggestion? We'd love to hear from you!</p>
                <p>
                    This web app was created by four third year students from Class 8 Group 1 of Informatics and Computing Engineering at FEUP:
                </p>
                <ul>
                    <li>Hugo Gomes</li>
                    <li>João Araújo</li>
                    <li>João Moreira</li>
                    <li>Lia Vieira</li>
                </ul>
                <a class="projectLink" href="https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/wikis/home">You cand find our project here</a>
            </div>
        </main>
    </body>
@endguest
