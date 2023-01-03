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
  <div class="container text-center boardView" id="boardView">
      <div class="row justify-content-between boardViewHeader">
        <div class="col-6">
          <h2>Team Members</h2>
        </div>
        <div class="col-4">
          <button type="submit" class="btn btn-outline-dark addMemberButton" data-bs-toggle="modal" data-bs-target="#addMembers">Add member</button>
        </div>
      </div>
      <div class="row" id="teamMembersBoard">
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
</main>

@endsection