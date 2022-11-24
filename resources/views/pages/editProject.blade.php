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


<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" id="teamMembers" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4" id="teamMembersTitle">Team Members</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      @foreach ($coordinators as $coordinator)
      <div class="coordinator dropdown">
        <li class="dropdown-item nav-item">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 40px;">
          <a href = "/profile/{{$coordinator['username']}}" class = "usernameCoordinator nav-item"><b>{{$coordinator['username']}}</b></a>
        </li>  
      </div>              
      @endforeach
      @foreach ($collaborators as $collaborator)
      <div class="collaborator dropdown">
      <ul class="dropdown-menu">
        <li class="dropdown-item nav-item">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 40px;">
          <a href = "/profile/{{$collaborator['username']}}" class = "usernameCollaborator nav-item" aria-current="page">{{$collaborator['username']}}</a>
          <div class="dropdown-content">
            <button class = "dropCButton" ><i class ="bi bi-caret-down-fill"></i></button>
            <div class = 'custom-select coordinatorDropdown'>
                <button class = "btn btn-outline-secondary removeMember">Remove</button>
                <button class = "btn btn-outline-secondary upgradeMember">Promote to coordinator</button>
            </div>
          </div>
        </li>   
      </ul> 
      </div>          
      @endforeach
    </ul>
  </div>
  </main>
@endsection
