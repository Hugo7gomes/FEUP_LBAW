@extends('layouts.app')

<div id="profileBoard">
  <div id="userProfile">
    <img src="{{ $photo['path'] }}">
    <h2>{{ $user['name'] }}</h2>
    <h3>{{ $user['email'] }}</h3>
  </div>
  <div id="userInfo">
    <form id="userInf">
      <h4>Name</h4>
      <input type="text" placeholder= "{{ $user['name'] }}" id="userName">
      <h4>Username</h4>
      <input type="text" placeholder= "{{ $user['username'] }}" id="userUsername">
      <h4>Email</h4>
      <input type="text" placeholder= "{{ $user['email'] }}" id="userEmail">
      <h4>Phone number</h4>
      <input type="tel" placeholder= "{{ $user['phone_number'] }}" id="userPhone">
    </form>
  </div>
  <section id="userProjects">
    <h2>My projects</h2>
    @foreach ($projects as $project)
    <h3>{{ $project['name']}}</h3>
    @endforeach
  </section>
</div>
