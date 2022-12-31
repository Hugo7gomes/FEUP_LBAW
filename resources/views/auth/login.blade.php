@extends('layouts.authenticate')

@section('login')

@section('content')

<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="{{ asset('css/login_register.css') }}" rel="stylesheet">

<header>
    <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
</header>
<div class = "loginBoard">
    <h1>Welcome Back!</h1>
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="loginField">
            <div class="form-group">
            <input id="emailLogin" name="email" type="text" class="form-control" placeholder="E-mail" required autofocus>
            @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
            @endif
            </div>
            <input id="passLogin" name="password" class="form-control" type="password" placeholder="Password" required>
            @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
            @endif
            <a href="{{route('password.request')}}"><span class="forgotPass">Forgot your password?</span></a>
            </div>
            <button class="btn btn-outline-dark loginButton" type="submit">
                Login
            </button>
            <div class = "signupLink">
                Not a member?<a href="{{ route('register') }}"> Register</a>
            </div>
        </div>
    </form>
</div>
           
@endsection