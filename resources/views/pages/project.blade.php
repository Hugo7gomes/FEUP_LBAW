@extends('layouts.app')

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

@section('name', $project->name)

@section('projectSide')
  @include('partials.project_side', ['projects' => $user->projects])
@endsection
<section id="projectSide">
    @yield('projectSide')
</section>

<button class="fa-regular fa-heart favoriteButton"></button>
<button class="addTaks">Add task</button>
<form method="POST" action = "" id="createTaks">
      @csrf
      <h4>Name</h4>
      <input type="text" name = "name" placeholder= "Name" id="taksName">
      @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
      @endif
      <h4>Details</h4>
      <input type="text" name = "details" placeholder= "Details" id="userEmail">
      @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
      @endif
      <h4>User assigned</h4>
      <select name="userAssigned">
        @foreach ($coordinators as $coordinator)
            <option value="{{ $coordinator['name']}}">{{ $coordinator['name']}}</option>
        @endforeach
        @foreach ($collaborators as $collaborator)
            <option value="{{ $collaborator['name']}}">{{ $collaborator['name']}}</option>
        @endforeach
      </select>
      <input type="tel" name = "phone_number" placeholder= "{{ $user['phone_number'] ?? 'No phoneNumber'}}" id="userPhone">
      @if($errors->has('phone_number'))
          <div class="error">{{ $errors->first('phone_number') }}</div>
      @endif
      <h4>Priority</h4>
      <input type="text" name = "password" placeholder= "User's password" id="password">
      @if($errors->has('password'))
          <div class="error">{{ $errors->first('password') }}</div>
      @endif
      <button type="submit" data-href="/profile/{{$user->username}}" class="btn btn-primary">Create task</button>
    </form>
<div class="boardView">
    <div>
        <h3>To do</h3>
        @foreach ($tasksToDo as $task)
        <div id="tasks">{{ $task['name']}}</div>
        @endforeach
    </div>
    <div>
        <h3>Doing</h3>
        @foreach ($tasksDoing as $task)
        <div id="tasks">{{ $task['name']}}</div>
        @endforeach
    </div>
    <div>
        <h3>Done</h3>
        @foreach ($tasksDone as $task)
        <div id="tasks">{{ $task['name']}}</div>
        @endforeach
    </div>
</div>
@if ($project->is_coordinator($user))
    <button class="editProjectButton" onclick="{{ route('project/id') }}">Editar projeto</button>
@endif

<div class="teamMembers">
    <h3>Team Members</h3>
    @foreach ($coordinators as $coordinator)
    <div class="coordinator"><b><a href = "/profile/{{$coordinator['username']}}">{{$coordinator['username']}}</a></b></div>
    
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div class="collaborator"><a href = "/profile/{{$collaborator['username']}}">{{$collaborator['username']}}</a></div>
    @endforeach
</div>
