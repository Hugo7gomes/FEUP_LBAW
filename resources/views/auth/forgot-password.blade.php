@extends('layouts.authenticate')

@section('forgot-password')

@section('content')

<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="{{ asset('css/login_register.css') }}" rel="stylesheet">

<header>
    <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" alt="LBAW logo" class= "logo"></a>
</header>
<div class = "loginBoard">
    <h1>Welcome Back!</h1>
    <form method="POST" action="/forgot-password">
        @csrf
        <div class="loginField">
            <div class="form-group">
                <input id="emailLogin" name="email" type="text" class="form-control" placeholder="E-mail" required autofocus>
                @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success mb-3" role="alert">
                    {{ Session::get('message') }}
                    </div>
                @endif
            </div>
            <button class="btn btn-outline-dark loginButton" type="submit">
                Reset password
            </button>
        </div>
    </form>
</div>
@endsection