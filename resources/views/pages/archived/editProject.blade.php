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
    <form class="editProjectForm"> <!-- METER SLUG CORRETA -->
      <div class="projectUpdateForm form-group">
        <label>Name</label>
        <div class="form-control" id="projectNewName" autofocus>{{ $project->name }}</div>
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
      </div>
      <div class="projectUpdateForm form-group">
        <label for="projectNewDetails">Description</label>
        <textarea disabled name="details" class=" form-control bg-white" rows = "3" id="projectNewDetails" placeholder="{{ $project->details }}">{{ $project->details }}</textarea>
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
    </div>
    </form>
  </div>
</main>
@endsection
