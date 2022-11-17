@extends('layouts.app')

@section('name', $project->name)

@section('projectSide')
  @include('partials.project_side', ['projects' => $user->projects])
@endsection
<section id="projectSide">
    @yield('projectSide')
</section>

<button class="fa-regular fa-heart favoriteButton"></button>
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
<div class="teamMembers">
    <h3>Team Members</h3>
    @foreach ($coordinators as $coordinator)
    <div class="coordinator"> <a href = "/profile/{{$coordinator['username']}}">{{$coordinator['username']}}</a></div>
    
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div class="collaborator"><a href = "/profile/{{$collaborator['username']}}">{{$collaborator['username']}}</a></div>
    
    @endforeach
</div>
@section('task')
  @include('partials.task_details', ['tasks' => $project->tasks])
@endsection
<section id="task">
    @yield('task')
</section>
