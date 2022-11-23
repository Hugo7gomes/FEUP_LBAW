@extends('layouts.app')

@section('edit task', $task->name)

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">

<header>
          @include('partials.header')
          @yield('header')
</header>
<main>
<div id="taskUpdate">
<form method="POST" action = "{{route('task/edit', ['id' => $task->id])}}" class="editTaskForm">
    @csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control" id="taskNewName" placeholder="{{ $task->name }}">
        @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="details" class="form-control" id="taskNewDetails" placeholder="{{ $task->details }}">
        @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
        @endif
    </div>
    <div class="custom-select">
        <select name="userAssigned" class="newUserAssigned">
            <option selected>Muda Moreira corno (nome user assigned)</option>
            @foreach ($tasks as $task)
                <option value="{{ $task['name']}}" name="{{ $task['name']}}">nome user assigned</option>
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
    <button type="submit" class="btn btn-outline-dark" id="updateTaskButton">Update Task</button>
</form>
</div>
</main>

@endsection