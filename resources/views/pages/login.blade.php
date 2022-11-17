@extends('layouts.main')

@section('content')
<div class = "loginBoard">
    <h1>Welcome Back!</h1>
    <h4>Username</h4>
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="loginField">
            <input id="usernameLogin" type="text" placeholder="Username" required autofocus>
            @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
            @endif
            <input id="passLogin" type="password" placeholder="Password" required>
            @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
            @endif
        </div>
        <div class="forgotPass">Forgot your password?</div>
        <button class="loginButton" type="submit">
            Login
        </button>
        <div class = "signupLink">
            Not a member?<a href="{{ route('register') }}">Register</a>
        </div>
    </form>
</div>
@endsection