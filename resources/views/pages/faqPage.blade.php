@if (!is_null($user))
    @extends('layouts.app')
    @section('Faqs')
    @section('content')

<link href="{{ asset('css/faq.css') }}" rel="stylesheet">
  
<main>
    @if ($admin)
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
    @foreach ($faqs as $faq)
        <div class="faq">
            <div class="faq-question">{{$faq->question }}</div>
            <div class="faq-answer">{{$faq->answer}}</div>
        </div>
    @endforeach
</main>
@endsection

@else
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
            <div id="contacts"><a href="{{ route('contacts') }}">Contacts</a></div>
        </div>
    </header>
    <main>
        <h1>Faqs:</h1>
        @foreach ($faqs as $faq)
            <div class="faq">
                <div class="faq-question">{{$faq->question }}</div>
                <div class="faq-answer">{{$faq->answer}}</div>
            </div>
        @endforeach
    </main>
</body>
@endif