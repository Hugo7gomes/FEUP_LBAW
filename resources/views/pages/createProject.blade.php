@extends('layouts.app')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">

<header>
          @include('partials.header')
          @yield('header')
</header>
<main>
<div id="createProject">
  <form method="POST" action = "{{ route('project/create') }}" class="createProjectForm">
    @csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control" id="projectName" placeholder="Name">
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="details" class="form-control" id="projectDetails" placeholder="Details">
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
    </div>
    <button type="submit" class="btn btn-outline-dark" id="createProjectButton">Create Project</button>
  </form>
</div>
</main>