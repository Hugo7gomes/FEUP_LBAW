@extends('layouts.app')

@section('name', $project->name)

@section('content')

<link href="{{ asset('css/project.css') }}" rel="stylesheet">
<link href="{{ asset('css/edit_task_side_nav.css') }}" rel="stylesheet">
<script src={{ asset('js/favorite.js') }} defer></script>
<script src={{ asset('js/task.js') }} defer></script>

<main>
  <section id="projectSide">
    @include('partials.project_side')
    @yield('project_side')
  </section> 

  <div class="container text-center boardView" id="boardView">
      <div class="row justify-content-between boardViewHeader">
        <div class="col-6">
          <h2>Board View - {{ $project->name }}</h2>
          <h2 id="archived">Archived</h2>
        </div>
        <div class="col-4">
          @if($project->is_favorite($user))
              <button type = "submit" class="btn btn-outline-danger btn-sm favoriteButton Button">REMOVE FAVORITE</button> 
          @else
            @if(count($user->favoriteProjects()) <= 10)
              <button type = "submit" class="btn btn-outline-dark btn-sm favoriteButton Button">FAVORITE</button>
            @else
              <button class="btn btn-outline-dark btn-sm favoriteButton Button" data-bs-toggle="modal" data-bs-target="#favoriteModal">FAVORITE</button>
            @endif
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col task tasksToDo">
          <div class="tasksToDoHeader">
            <h3>To do</h3>
          </div>
          @foreach ($project->tasksToDo() as $taskToDo)
            <a id = {{$taskToDo->id}} class = "taskLink" >
              <div id="tasks">{{ $taskToDo['name']}}</div>
            </a>
          @endforeach
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li><span class="page-item">{{$project->tasksToDo()->links('pagination::simple-bootstrap-4')}}</span></li>
            </ul>
          </nav>
        </div>
        <div class="col task tasksDoing">
            <h3>Doing</h3>
            @foreach ($project->tasksDoing() as $taskDoing)
              <a id = {{$taskDoing->id}} class = "taskLink" >
                <div id="tasks">{{ $taskDoing['name']}}</div>
              </a>
            @endforeach
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li><span class="page-item">{{$project->tasksDoing()->links('pagination::simple-bootstrap-4')}}</span></li>
              </ul>
            </nav>
        </div>
        <div class="col task tasksDone">
            <h3>Done</h3>
            @foreach ($project->tasksDone() as $taskDone)
              <a id = {{$taskDone->id}} class = "taskLink" >
                <div id="tasks">{{ $taskDone['name']}}</div>
              </a>
            @endforeach
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li><span class="page-item">{{$project->tasksDone()->links('pagination::simple-bootstrap-4')}}</span></li>
              </ul>
            </nav>
        </div>
      </div>
  </div>
  @if(count($user->favoriteProjects()) > 10)
  <div class="modal " id="favoriteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reached the limit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>You reached the limit of favorite projects. </p>
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class = "offcanvasDiv"></div>
</main>
@endsection
