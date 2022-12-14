@extends('layouts.app')

@section('edit task', $task->name)

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">

<main>
<div id="taskUpdate">
<form method="POST" action = "{{route('task/edit', ['id' => $task->id])}}" class="editTaskForm">
    @csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control" id="taskNewName" placeholder="{{ $task->name ?? 'Task Name' }}">
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="details" class="form-control" id="taskNewDetails" placeholder="{{ $task->details ?? 'Task details'}}">
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
    </div>
    <div class="custom-select">
        <select name="userAssigned" class="newUserAssigned">
            <option selected>{{ $userToAssign->name ?? 'User assigned' }}</option>
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
    <div class="custom-select">
        <select name="priority" class="optionsPriority">
            <option selected>{{ $task->priority }}</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        @if($errors->has('priority'))
            <div class="error">{{ $errors->first('priority') }}</div>
        @endif
    </div>
    <div class="custom-select">
        <select name="state" class="optionsState">
            <option selected>{{ $task->state }}</option>
            <option value="To Do">To Do</option>
            <option value="Doing">Doing</option>
            <option value="Done">Done</option>
        </select>
        @if($errors->has('state'))
            <div class="error">{{ $errors->first('state') }}</div>
        @endif
    </div>
    <button type="submit" class="btn btn-outline-dark" id="updateTaskButton">Update Task</button>
    <a href = "{{route('task/delete', ['id' => $task->id])}}"><button class="btn btn-outline-danger" type="button" id="deleteTaskButton">Delete Task</button></a>
</form>
</div>
</main>

@endsection