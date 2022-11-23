@extends('layouts.app')

@section('edit name', $project->name)

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">
<script src={{ asset('js/teamMembers.js') }} defer></script>


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
    <div class="coordinator dropdown">
      <a href = "/profile/{{$coordinator['username']}}" class = "username">{{$coordinator['username']}}</a>
    </div>              
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div class="collaborator dropdown">
      <a href = "/profile/{{$collaborator['username']}}" class = "username">{{$collaborator['username']}}</a>
      <button class = "btn btn-outline-dark dropCButton" ><i class ="bi bi-bell"></i></button>
      <div class = 'custom-select coordinatorDropdown'>
          <button class = "btn btn-outline-dark removeMember">Remove</button>
          <button class = "btn btn-outline-dark upgradeMember">Upgrade to coordinator</button>
      </div>
    </div> 
    @endforeach
</div>
</main>
 
@endsection