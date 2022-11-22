@extends('layouts.app')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">

<header>
          @include('partials.header')
          @yield('header')
</header>
<main>
<div id="projectUpdate">
<form method="POST" action = "{{route('project/edit', ['id' => $project->id])}}" class="editProjectForm"> <!-- METER SLUG CORRETA -->
    @csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control" id="projectNewName" placeholder="{{ $project->name }}" autofocus>
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="details" class="form-control" id="projectNewDetails" placeholder="{{ $project->details }}">
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
    </div>
    <button type="submit" class="btn btn-outline-dark" id="updateProjectButton">Update Project</button>
</form>
</div>
<div class="teamMembers">
    <h3>Team Members</h3>
    @foreach ($coordinators as $coordinator)
    <div class="coordinator"><b><a href = "/profile/{{$coordinator['username']}}">{{$coordinator['username']}}</a></b></div>
    
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div class="collaborator"><a href = "/profile/{{$collaborator['username']}}">{{$collaborator['username']}}</a></div>
    @endforeach
</div>
</main>
