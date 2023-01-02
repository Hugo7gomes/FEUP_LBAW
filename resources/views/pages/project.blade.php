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
        <div class="col-4">
          <h2>Board View - {{ $project->name }}</h2>
        </div>
        <div class="col-4">
          @if($project->is_favorite($user))
            <button type = "submit" class="btn btn-outline-danger btn-sm favoriteButton Button">REMOVE FAVORITE</button> 
          @else
          <button type = "submit" class="btn btn-outline-dark btn-sm favoriteButton Button">FAVORITE</button>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col task tasksToDo">
          <div class="tasksToDoHeader">
            <h3>To do</h3>
            <button class="addTaskToDo btn btn-outline-dark rounded addTask" data-bs-toggle="modal" data-bs-target="#createTask">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
              </svg>
            </button>
          </div>
          @foreach ($project->tasksToDo() as $taskToDo)
            <a id = {{$taskToDo->id}} class = "taskLink" >
              <div id="tasks">{{ $taskToDo['name']}}</div>
            </a>
          @endforeach
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <span class="page-item">{{$project->tasksToDo()->links('pagination::simple-bootstrap-4')}}</span>
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
                <span class="page-item">{{$project->tasksDoing()->links('pagination::simple-bootstrap-4')}}</span>
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
                <span class="page-item">{{$project->tasksDone()->links('pagination::simple-bootstrap-4')}}</span>
              </ul>
            </nav>
        </div>
      </div>
  </div>
  <div class ="modal" id="createTask">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Task</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action = "{{ route('task/create', ['id'=>$project->id]) }}" class="createTaskForm">
                @csrf
              <div class="form-group newTask">
                  <input type="text" name="name" class="form-control" id="taskName" placeholder="Name" required>
                  @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                  @endif
              </div>
              <div class="form-group newTask">
                <textarea name="details" class="form-control" rows = "3" id="projectDetails" placeholder="Details"></textarea>
                @if($errors->has('details'))
                  <div class="error">{{ $errors->first('details') }}</div>
                @endif
              </div>
              <div class="form_select newTaskSelect">
                <select name="userAssigned" class="optionsUserAssigned custom-select">
                    <option selected>User assigned</option>
                    @foreach ($project->getCoordinators() as $coordinator)
                        <option value="{{ $coordinator['name']}}" name="{{ $coordinator['name']}}">{{ $coordinator['name']}}</option>
                    @endforeach
                    @foreach ($project->getCollaborators() as $collaborator)
                        <option value="{{ $collaborator['name']}}" name="{{ $collaborator['name']}}">{{ $collaborator['name']}}</option>
                    @endforeach
                    <label for="floatingInput">User Assigned</label>
                </select>
                @if($errors->has('id_user_assigned'))
                  <div class="error">{{ $errors->first('id_user_assigned') }}</div>
                @endif
              </div>
              <div class="form_select newTaskSelect">
                  <select name="priority" class="optionsPriority custom-select">
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
        </div>
      </div>
    </div>
  </div>
  <div class = "offcanvasDiv"></div>
</main>
@endsection


