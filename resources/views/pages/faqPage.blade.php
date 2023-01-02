@auth
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
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
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
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
        @if($user->administrator)
            <form method="POST" action = "{{route('faq') }}">
                <h1>Add a new FAQ</h1>
                @csrf
                <label for="question">Question:</label><br>
                <input type="text" name="question" id="question" name="question"><br>
                <label for="answer">Answer:</label><br>
                <textarea id="answer" name="answer" name="answer"></textarea><br><br>
                <input type="submit" value="Confirm">
            </form> 
        @endif
        <h1>Faqs:</h1>
        <div id = "all_faqs">
        @foreach ($faqs as $faq)
            <div class="faq">
                <div class="faq-question">{{$faq->question }}</div>
                <div class="faq-answer">{{$faq->answer}}</div>
            </div>
        @endforeach
        <div id = "all_faqs">
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
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
            <div id="headerInfo">
                <div id="about"><a href="{{ route('about') }}">About</a></div>
                <div id="contacts"><a href="{{ route('contact') }}">Contacts</a></div>
            </div>
        </header>
        <main>
            <h1>Faqs:</h1>
            <div id = "all_faqs">
            @foreach ($faqs as $faq)
                    <div class="faq">
                        <div class="faq-question">{{$faq->question }}</div>
                        <div class="faq-answer">{{$faq->answer}}</div>
                    </div>
            @endforeach
            </div>
        </main>
    </body>
@endguest