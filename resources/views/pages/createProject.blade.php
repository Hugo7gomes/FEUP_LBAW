@extends('layouts.app')

@section('createProject')

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">


<main>
<div id="createProject">
  <form method="POST" action = "{{ route('project/create') }}" class="createProjectForm">
  <h4>New Project</h4>
    @csrf
    <div class="form-group">
      <input type="text" name="name" class="form-control" id="projectName" placeholder="Name">
      @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
      @endif
    </div>
    <div class="form-group">
      <textarea name="details" class="form-control" id="projectDetails" placeholder="Details" rows = "3"></textarea>
      @if($errors->has('details'))
        <div class="error">{{ $errors->first('details') }}</div>
      @endif
    </div>
    <button type="submit" class="btn btn-outline-dark" id="createProjectButton">Create Project</button>
  </form>
</div>
</main>
@endsection