@extends('layouts.app')

@section('team members', $project->name)

@section('content')

<link href="{{ asset('css/team_members.css') }}" rel="stylesheet">
<script src={{ asset('js/teamMembers.js') }} defer></script>

<main>
    <section id="projectSide">
        @include('partials.project_side')
        @yield('project_side')
    </section>

  <div class="container text-center" id="projectMembers">
    <div class="col"><button type="submit" class="btn btn-outline-dark addMemberButton" data-bs-toggle="modal" data-bs-target="#addMembers">Add member</button></div>
      <div class="row">
          <div class="col">
          <input type="text" name="username" class="form-group"  id="chooseProfile" placeholder="Search?">
          </div>
      </div>
      <div class="row">
        <div class="col members">
          @foreach ($project->getCoordinators() as $coordinator)
            <li class="bla dropdown-item nav-item">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 40px;">
              <a href = "/profile/{{$coordinator['username']}}" class = "usernameCoordinator nav-item"><b>{{$coordinator['username']}}</b></a>
              <span>Coordinator</span>
            </li>         
          @endforeach
          @foreach ($project->getCollaborators() as $collaborator)
            <li class="bla dropdown-item nav-item">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 40px;">
              <a href = "/profile/{{$collaborator['username']}}" class = "usernameCollaborator nav-item" aria-current="page">{{$collaborator['username']}}</a>
              <span>Collaborator</span>
                <button class = "btn btn-outline-secondary removeMember">Remove</button>
                <button class = "btn btn-outline-secondary upgradeMember">Promote to coordinator</button>
            </li>             
          @endforeach
        </div>
      </div>
  </div>


    <!-- <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" id="teamMembers" style="width: 280px;">
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
    </div> -->
    

    <div class ="modal" id="addMembers">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Member</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          @if ($project->is_coordinator($user))
          <form method = "POST" class="addToProject" action="{{ route('project/inviteMember', ['id'=> $project->id]) }}">
              @csrf
              <label for="projects">Choose a profile</label>
              <input type="text" name="username" class="form-group"  id="chooseProfile" placeholder="username">
              @if($errors->has('userNotFound'))
              <div class="error">{{ $errors->first('userNotFound') }}</div>
              @endif
              <button type="submit" class="btn btn-outline-dark addMemberButtonModal">Add member</button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div> 



</main>

@endsection