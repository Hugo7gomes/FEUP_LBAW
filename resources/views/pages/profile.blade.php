@extends('layouts.app')

<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div id="profileBoard">
  <div id="userProfile">
    <img src="{{ $photo['path'] ?? 'docs/profiles/default' }}">
    <h2>{{ $user['name'] }}</h2>
    <h3>{{ $user['email'] }}</h3>
  </div>
  <div id="userInfo">
    <form method="POST" action = "{{ route('profile') }}" id="userInf">
      @csrf
      <h4>Name</h4>
      <input type="text" name = "name" placeholder= "{{ $user['name'] }}" id="userName">
      @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
      @endif
      <h4>Username</h4>
      <input type="text" name = "username" placeholder= "{{ $user['username'] }}" id="userUsername">
      @if($errors->has('username'))
          <div class="error">{{ $errors->first('username') }}</div>
      @endif
      <h4>Email</h4>
      <input type="text" name = "email" placeholder= "{{ $user['email'] }}" id="userEmail">
      @if($errors->has('email'))
          <div class="error">{{ $errors->first('email') }}</div>
      @endif
      <h4>Phone number</h4>
      <input type="tel" name = "phone_number" placeholder= "{{ $user['phone_number'] ?? 'No phoneNumber'}}" id="userPhone">
      @if($errors->has('phone_number'))
          <div class="error">{{ $errors->first('phone_number') }}</div>
      @endif
      <h4>Password</h4>
      <input type="text" name = "password" placeholder= "User's password" id="password">
      @if($errors->has('password'))
          <div class="error">{{ $errors->first('password') }}</div>
      @endif
      <h4>New Password</h4>
      <input type="text" name = "new_password" placeholder= "User's new password" id="new_password">
      @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
      @endif
      <button type="submit" data-href="/profile/{{$user->username}}" class="btn btn-primary">Update</button>
    </form>
  </div>
  <section id="userProjects">
    <h2>My projects</h2>
    @foreach ($projects as $project)
    <h3>{{ $project['name']}}</h3>
    @endforeach
  </section>
</div>
