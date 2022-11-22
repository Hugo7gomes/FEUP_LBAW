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
</main>

 