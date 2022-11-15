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
        @foreach ($tasks as $taks)
        <div id="tasks">{{ $project['name']}}</div>
        @endforeach
    </div>
    <div>
        <h3>Doing</h3>
    </div>
    <div>
        <h3>Done</h3>
    </div>
</div>
<div class="teamMembers">
    <h3>Team Members</h3>
    @foreach ($coordinators as $coordinator)
    <div id="coordinator">{{ $coordinator['name']}}</div>
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div id="collaborator">{{ $collaborator['name']}}</div>
    @endforeach
</div>
@section('task')
  @include('partials.task_details', ['tasks' => $project->tasks])
@endsection
<section id="task">
    @yield('task')
</section>
