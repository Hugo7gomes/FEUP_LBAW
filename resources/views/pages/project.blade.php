@extends('layouts.app')

@section('name', $project->name)

@section('content')

<link href="{{ asset('css/project.css') }}" rel="stylesheet">
<script src={{ asset('js/task.js') }} defer></script>
<script src={{ asset('js/favorite.js') }} defer></script>

<main>
  <div class = "allButtons">
    @if($project->is_favorite($user))
    <button type = "submit" class="btn btn-outline-danger favoriteButton Button">REMOVE FAVORITE</button> 
    @else
    <button type = "submit" class="btn btn-outline-dark favoriteButton Button">FAVORITE</button>
    @endif
    <button class="btn btn-outline-dark addTask Button" >Add task</button>

      @if ($project->is_coordinator($user))
    <a href = "{{route('project/editShow', ['id' => $project->id])}}"><button class="btn btn-outline-dark Button" id="editProjectButton">Edit project</button></a>
      @endif

    <form method="POST" action = "{{ route('project/leave', ['id'=>$project->id]) }}">
      @csrf
      <button type="submit" class="btn btn-outline-danger Button" id="leaveProjectButton">Leave Project</button>
    </form>
  </div>
  <div id="createTask" style="display: none;">
    <form method="POST" action = "{{ route('task/create', ['id'=>$project->id]) }}" class="createTaskForm">
          @csrf
        <div class="form-group">
            <input type="text" name="name" class="form-control" id="taskName" placeholder="Name" required>
            @if($errors->has('name'))
              <div class="error">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
          <textarea name="details" class="form-control" rows = "3" id="projectDetails" placeholder="Details"></textarea>
          @if($errors->has('details'))
            <div class="error">{{ $errors->first('details') }}</div>
          @endif
        </div>
        <div class="form_select">
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
        <div class="form_select">
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
  <div class="container text-center boardView" id="boardView">
      <div class="row">
        <h2>Board View - {{ $project->name }}</h2>
        <div class="col task tasksToDo">
            <h3>To do</h3>
            @foreach ($project->tasksToDo() as $taskToDo)
            <a href = "{{route('task/editShow', ['taskId' => $taskToDo->id, 'projectId' => $project->id])}}"><div id="tasks">{{ $taskToDo['name']}}</div></a>
            @endforeach
            <span id="page-item">{{$project->tasksToDo()->links()}}</span>
        </div>
        <div class="col task tasksDoing">
            <h3>Doing</h3>
            @foreach ($project->tasksDoing() as $taskDoing)
            <a href = "{{route('task/editShow', ['taskId' => $taskDoing->id, 'projectId' => $project->id])}}"><div id="tasks">{{ $taskDoing['name']}}</div></a>
            @endforeach
            <span>{{$project->tasksDoing()->links()}}</span>
        </div>
        <div class="col task tasksDone">
            <h3>Done</h3>
            @foreach ($project->tasksDone() as $taskDone)
            <a href = "{{route('task/editShow', ['taskId' => $taskDone->id, 'projectId' => $project->id])}}"><div id="tasks">{{ $taskDone['name']}}</div></a>
            @endforeach
            <span>{{$project->tasksDone()->links()}}</span>
        </div>
      </div>
  </div>
</main>
@endsection


