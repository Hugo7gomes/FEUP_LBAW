@extends('layouts.main')

<div id="profileBoard">
    <div id="userProfile">
    <img src="{{ $photo['path'] ?? 'docs/profiles/default' }}">
    <h2>{{ $user['name'] }}</h2>
    <h3>{{ $user['email'] }}</h3>
    </div>
    <div id="userInfo">
        <h4>Name</h4>
        <h5>{{ $user['name']}}</h5>
        <h4>Username</h4>
        <h5>{{ $user['username']}}</h5>
        <h4>Email</h4>
        <h5>{{ $user['email']}}</h5>
        <h4>Phone number</h4>
        <h5>{{ $user['phone_number']}}</h5>
    </div>
    <section id="userProjects">
    <h2>My projects</h2>
    @foreach ($projects as $project)
    <h3>{{ $project['name']}}</h3>
    @endforeach
    </section>
</div>
