@extends('layouts.app')

@section('edit name', $project->name)

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">
<script src={{ asset('js/teamMembers.js') }} defer></script>


<main>
<div id="projectUpdate">
  <form method="POST" action = "{{route('project/edit', ['id' => $project->id])}}" class="editProjectForm"> <!-- METER SLUG CORRETA -->
    @csrf
    <div class="projectUpdateForm form-group">
      <label for="projectNewName">Name</label>
      <input type="text" name="name" class="form-control" id="projectNewName" placeholder="{{ $project->name }}" autofocus>
      @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
      @endif
    </div>
    <div class="form-group">
      <label for="projectNewDetails">Description</label>
      <textarea name="details" class="form-control" rows = "3" id="projectNewDetails" placeholder="{{ $project->details }}"></textarea>
      @if($errors->has('details'))
        <div class="error">{{ $errors->first('details') }}</div>
      @endif
    </div>
    <button type="submit" class="btn btn-outline-dark" id="updateProjectButton">Update Project</button>
  </form>
<!-- </div> -->

  <div class="container text-center" id="addMember">
    <span class="fs-4" id="addMembersTitle">Add Member</span>
    @if ($project->is_coordinator($user))
    <form method = "POST" class="addToProject" action="{{ route('project/inviteMember', ['id'=> $project->id]) }}">
      @csrf
      <label for="projects">Choose a profile</label>
      <input type="text" name="username" class="form-group"  id="chooseProfile" placeholder="username">
      @if($errors->has('userNotFound'))
        <div class="error">{{ $errors->first('userNotFound') }}</div>
      @endif
      <button type="submit" class="btn btn-outline-dark addMemberButton">Add member</button>
    </form>
    @endif
  </div> 
</div>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" id="teamMembers" style="width: 280px;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    <span class="fs-4" id="teamMembersTitle">Team Members</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    @foreach ($project->getCoordinators() as $coordinator)
    <div class="coordinator dropdown">
      <li class=" bla dropdown-item nav-item">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 40px;">
        <a href = "/profile/{{$coordinator['username']}}" class = "usernameCoordinator nav-item"><b>{{$coordinator['username']}}</b></a>
      </li>  
    </div>              
    @endforeach
    @foreach ($project->getCollaborators() as $collaborator)
    <div class="collaborator dropdown">
      <li class="bla dropdown-item nav-item">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 40px;">
        <a href = "/profile/{{$collaborator['username']}}" class = "usernameCollaborator nav-item" aria-current="page">{{$collaborator['username']}}</a>
        <button class = "dropCButton" ><i class ="bi bi-caret-down-fill"></i></button>
        <div class="dropdown-content">
          <div class = 'coordinatorDropdown' style="display: none;">
            <button class = "btn btn-outline-secondary removeMember">Remove</button>
            <button class = "btn btn-outline-secondary upgradeMember">Promote to coordinator</button>
          </div>
        </div>
      </li>   
    </div>          
    @endforeach
  </ul>
</div>


</main>
@endsection
