@extends('layouts.authenticate')

@section('register')

@section('content')

<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="{{ asset('css/login_register.css') }}" rel="stylesheet">

<header>
    <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
</header>
<div class = "registerBoard">
  <h1>Register</h1>
  <form method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
      <div class="registerField">
        <input id="nameReg" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
          <span class="error">
              {{ $errors->first('name') }}
          </span>
        @endif
        <!-- <label for="username">Username</label> -->
        <input id="usernameReg" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
        @if ($errors->has('username'))
          <span class="error">
              {{ $errors->first('username') }}
          </span>
        @endif
      <!-- <label for="email">E-mail</label> -->
        <input id="emailReg" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
          <span class="error">
              {{ $errors->first('email') }}
          </span>
        @endif
      <!-- <label for="password">Password</label> -->
        <input id="passwordReg" type="password" name="password" placeholder="Password" required>
        @if ($errors->has('password'))
          <span class="error">
              {{ $errors->first('password') }}
          </span>
        @endif
        <!-- <label for="password-confirm">Confirm Password</label> -->
        <input id="passwordConfirmReg" type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button class="registerButton" type="submit">
          Register
        </button>
      <div class = "loginLink">
        Already a member?<a href="{{ route('login') }}"> Login</a>
      </div>
    </form>
</div>

@endsection