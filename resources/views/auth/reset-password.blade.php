@extends('layouts.authenticate')

@section('reset-password')

@section('content')

<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="{{ asset('css/login_register.css') }}" rel="stylesheet">

<header>
    <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
</header>
<div class = "loginBoard">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" value="{{ $token }}" name="token">
        <div class="resetField">
            <div class="form-group">
                <input id="emailResetPass" name="email" type="text" class="form-control" placeholder="E-mail" required autofocus>
                @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
                @endif
                <input type="password" name = "password" class="form-control" placeholder= "New password" id="passReset">
                @if ($errors->has('password'))
                <span class="error">
                    {{ $errors->first('password') }}
                </span>
                @endif
                <input type="password" name = "password_confirmation" class="form-control" placeholder= "New password Confirmation" id="newPassReset">
                @if ($errors->has('password'))
                <span class="error">
                    {{ $errors->first('password') }}
                </span>
                @endif
            </div>
            <button class="btn btn-outline-dark resetPassButton" type="submit">
                Recover password
            </button>
        </div>
    </form>
</div>