@extends('layouts.app')

@section('name', $project->name)

<link href="{{ asset('css/project.css') }}" rel="stylesheet">
<script src={{ asset('js/task.js') }} defer></script>
<script src={{ asset('js/notification.js') }} defer></script>
<header>
          @include('partials.header')
          @yield('header')
</header>
<main>
@section('projectSide')
  @include('partials.project_side', ['projects' => $user->projects])
@endsection
<section id="projectSide">
    @yield('projectSide')
</section>


<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

<button type="button" class="btn btn-outline-dark addTask" data-toggle="modal" data-target="#exampleModalCenter">Add task</button>
<div class="modal fade .modal-dialog-centered" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>ola</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- <form method = "POST" action = "{{route('project/favorite', ['id'=>$project->id])}}">
    @csrf
    <button type = "submit" class="btn btn-outline-dark favoriteButton">Favorite</button>
</form>
<button class="btn btn-outline-dark addTask" >Add task</button>
<div id="createTask">
<form method="POST" action = "{{ route('task/create', ['id'=>$project->id]) }}" class="createTaskForm">
      @csrf

    <div class="form-group">
        <input type="text" name="name" class="form-control" id="taskName" placeholder="Name">
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="details" class="form-control" id="userEmail" placeholder="Details">
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
    </div>
    <div class="custom-select">
        <select name="userAssigned" class="optionsUserAssigned">
            <option selected>User assigned</option>
            @foreach ($coordinators as $coordinator)
                <option value="{{ $coordinator['name']}}" name="{{ $coordinator['name']}}">{{ $coordinator['name']}}</option>
            @endforeach
            @foreach ($collaborators as $collaborator)
                <option value="{{ $collaborator['name']}}" name="{{ $collaborator['name']}}">{{ $collaborator['name']}}</option>
            @endforeach
            <label for="floatingInput">User Assigned</label>
        </select>
        @if($errors->has('id_user_assigned'))
          <div class="error">{{ $errors->first('id_user_assigned') }}</div>
        @endif
    </div>
    <div class="custom-select">
        <select name="priority" class="optionsPriority">
            <option selected>Priority</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        @if($errors->has('priority'))
            <div class="error">{{ $errors->first('priority') }}</div>
        @endif
    </div>
    
    <button type="submit" class="btn btn-outline-dark" id="createTaskButton">Create task</button>
</form>
</div> -->

<div class="buttons">
<form method="POST" action = "{{ route('project/leave', ['id'=>$project->id]) }}">
    @csrf
    <button type="submit" class="btn btn-outline-dark" id="leaveProjectButton">Leave Project</button>
</form>
</div>
<div class="container text-center boardView" id="boardView">
    <div class="row">
    <h2>Board View</h2>
    <div class="col tasksToDo">
        <h3>To do</h3>
        @foreach ($tasksToDo as $task)
        <a href = "{{route('task', ['id' => $task->id])}}"><div id="tasks">{{ $task['name']}}</div></a>
        @endforeach
    </div>
    <div class="col tasksDoing">
        <h3>Doing</h3>
        @foreach ($tasksDoing as $task)
        <a href = "{{route('task', ['id' => $task->id])}}"><div id="tasks">{{ $task['name']}}</div></a>
        @endforeach
    </div>
    <div class="col tasksDone">
        <h3>Done</h3>
        @foreach ($tasksDone as $task)
        <a href = "{{route('task', ['id' => $task->id])}}"><div id="tasks">{{ $task['name']}}</div></a>
        @endforeach
    </div>
</div>
</div>

<!-- FALTA MOSTRAR DETAILS DO PROJETO -->
<div class="buttons">
@if ($project->is_coordinator($user))
    <a href = "{{route('project/edit', ['id' => $project->id])}}"><button class="btn btn-outline-dark" id="editProjectButton">Edit project</button></a>
@endif
</div>
<div class="container text-center" id="addMember">
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
</main>

<!-- <div class="teamMembers">
    <h3>Team Members</h3>
    @foreach ($coordinators as $coordinator)
    <div class="coordinator"><b><a href = "/profile/{{$coordinator['username']}}">{{$coordinator['username']}}</a></b></div>
    
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div class="collaborator"><a href = "/profile/{{$collaborator['username']}}">{{$collaborator['username']}}</a></div>
    @endforeach
</div> -->
