@extends('layouts.app')

@section('edit name', $project->name)

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">

<script src={{ asset('js/teamMembers.js') }} defer></script>

<main>
  <section id="projectSide">
    @include('partials.project_side')
    @yield('project_side')
  </section>

  <div id="projectUpdate">
    <form method="POST" action = "{{route('project.edit', ['project_id' => $project->id])}}" class="editProjectForm"> <!-- METER SLUG CORRETA -->
      @csrf
      <div class="projectUpdateForm form-group">
        <label for="projectNewName">Name</label>
        <input type="text" name="name" class="form-control" id="projectNewName" placeholder="{{ $project->name }}" autofocus>
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
      </div>
      <div class="projectUpdateForm form-group">
        <label for="projectNewDetails">Description</label>
        <textarea name="details" class="form-control" rows = "3" id="projectNewDetails" placeholder="{{ $project->details }}"></textarea>
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
      </div>
      <button type="submit" class="btn btn-outline-dark" id="updateProjectButton">Update Project</button>
    </form>
  </div>
</main>
@endsection
