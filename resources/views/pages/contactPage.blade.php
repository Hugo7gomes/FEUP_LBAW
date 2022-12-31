@if(!is_null($user))
    @extends('layouts.app')
    @section('Contacts')
    @section('content')

    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">
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
    @endsection
@else
<!DOCTYPE html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
            <div id="headerInfo">
                <div id="faqs"><a href="{{ route('faq') }}">FAQ</a></div>
                <div id="contacts"><a href="{{ route('about') }}">About</a></div>
            </div>
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
                <li>You cand find our project here <a href="https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/wikis/home"></a> </li>
            </ul>
        </main>
    </body>
@endif
