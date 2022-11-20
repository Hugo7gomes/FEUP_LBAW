@extends('layouts.app')

@section('projectSide')
  @include('partials.project_side', ['projects' => $user->projects])
@endsection
<section id="projectSide">
    @yield('projectSide')
</section>

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
    </div>
    <section id="userProjects">
    <h2>{{ $user['name']}}</h2><h2>'s projects</h2>
    @foreach ($projects as $project)
    <h3>{{ $project['name']}}</h3>
    @endforeach
    </section>
    <button class="fa-solid fa-plus inviteToProject" onclick=""></button>
</div>
