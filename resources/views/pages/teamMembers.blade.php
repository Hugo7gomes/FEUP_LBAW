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
    @if ($project->is_coordinator($user))
    <div class="col">
      <button type="submit" class="btn btn-outline-dark addMemberButton" data-bs-toggle="modal" data-bs-target="#addMembers">Add member</button>
    </div>
    @endif
      <div class="row">
          <div class="col">
            <input type="text" name="username" class="form-group" placeholder="Search?">
          </div>
      </div>
      <div class="row">
        <div class="col members">
          @foreach ($project->getCoordinators() as $coordinator)
            <li class="bla dropdown-item nav-item">
              <div class="memberInfo">
                @if($coordinator['photo'] != null)
                  <img src={{asset($coordinator['photo'])}} alt="avatar" class="rounded-circle img-fluid" style="width: 40px; height:40px;">
                @else
                  <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle img-fluid" style="width: 40px; height:40px;">
                @endif  
                <a href = "/profile/{{$coordinator['username']}}" class = "usernameCoordinator nav-item"><b>{{$coordinator['username']}}</b></a>
                <span>Coordinator</span>
              </div>
            </li>      
          @endforeach
          @foreach ($project->getCollaborators() as $collaborator)
            <li class="bla dropdown-item nav-item">
              <div class="memberInfo">
                @if($collaborator['photo'] != null)
                  <img src={{asset($collaborator['photo'])}} alt="avatar" class="rounded-circle img-fluid" style="width: 40px; height:40px;">
                @else
                  <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle img-fluid" style="width: 40px; height:40px;">
                @endif  
                <a href = "/profile/{{$collaborator['username']}}" class = "usernameCollaborator nav-item" aria-current="page">{{$collaborator['username']}}</a>
                <span>Collaborator</span>
              </div>
              @if ($project->is_coordinator($user))
              <div class="memberButtons">
                <button class = "btn btn-outline-secondary removeMember">Remove</button>
                <button class = "btn btn-outline-secondary upgradeMember">Promote to coordinator</button>
              </div>
            </li>
            @endif             
          @endforeach
        </div>
      </div>
  </div>
    @if ($project->is_coordinator($user))
    <div class ="modal" id="addMembers">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Member</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
              <div class="addToProject" >
                  @csrf
                  <label for="projects">Choose a profile</label>
                  <input type="text" name="username" class="form-group"  id="chooseProfile" placeholder="username" >
                  <div class="errorMember"></div>
                  <button class="btn btn-outline-dark addMemberButtonModal">Add member</button>
              </div>
          </div>
        </div>
      </div>
    </div> 
    @endif
</main>

@endsection