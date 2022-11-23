@extends('layouts.app')

<!-- <link href="{{ asset('css/task.css') }}" rel="stylesheet"> -->

@section('name', $task->name)

@section('content')

<main>
  @section('projectSide')
    @include('partials.project_side', ['projects' => $user->projects])
  @endsection
  <section id="projectSide">
      @yield('projectSide')
  </section>

  <div class="container text-center taskView">
      <div id="taskName">{{ $task['name']}}</div>
      <div id="taskDetails">{{ $task['details']}}</div>
      <div class="col tasksComments">
      </div>
      <button type="submit" class="btn btn-outline-dark">Edit Task</button>
  </div>
</main>

@endsection