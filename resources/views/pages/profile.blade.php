@extends('layouts.app')

    <!-- <div class="col-sm-3">
      Level 1: .col-sm-3
    </div>
    <div class="col-sm-9">
      <div class="row">
        <div class="col-8 col-sm-6">
          Level 2: .col-8 .col-sm-6
        </div>
        <div class="col-4 col-sm-6">
          Level 2: .col-4 .col-sm-6
        </div>
      </div>
    </div> -->


<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="container text-center" id="profileBoard">
  <div class="row">
    <div class="col-sm-3" id="userProfile">
      <img src="{{ $photo['path'] ?? 'docs/profiles/default' }}">
      <h2>{{ $user['name'] }}</h2>
      <h3>{{ $user['email'] }}</h3>
    </div>
    <div class="col-sm-9" id="userInfo">
      <div class="row">
      <div class="col-8 col-sm-6">
      <form method="POST" action = "{{ route('profile') }}" id="userInf">
        @csrf
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" name = "name" placeholder= "{{ $user['name'] }}" id="userName" class="form-control form-control-lg">
        @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif
        <label for="exampleFormControlInput1" class="form-label">Username</label>
        <input type="text" name = "username" placeholder= "{{ $user['username'] }}" id="userUsername" class="form-control form-control-lg">
        @if($errors->has('username'))
            <div class="error">{{ $errors->first('username') }}</div>
        @endif
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input type="text" name = "email" placeholder= "{{ $user['email'] }}" id="userEmail" class="form-control form-control-lg">
        @if($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
        @endif
        <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
        <input type="tel" name = "phone_number" placeholder= "{{ $user['phone_number'] ?? 'No phoneNumber'}}" id="userPhone" class="form-control form-control-lg">
        @if($errors->has('phone_number'))
            <div class="error">{{ $errors->first('phone_number') }}</div>
        @endif
        <label for="exampleFormControlInput1" class="form-label">Password</label>
        <input type="text" name = "password" placeholder= "User's password" id="password" class="form-control form-control-lg">
        @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
        @endif
        <label for="exampleFormControlInput1" class="form-label">New Password</label>
        <input type="text" name = "new_password" placeholder= "User's new password" id="new_password" class="form-control form-control-lg">
        @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif
        <button type="submit" data-href="/profile/{{$user->username}}" class="btn btn-outline-dark">Update</button>
      </form>
      </div>

    <section id="userProjects">
      <h2>My projects</h2>
      @foreach ($projects as $project)
      <h3>{{ $project['name']}}</h3>
      @endforeach
    </section>
    </div>
  </div>
</div>
