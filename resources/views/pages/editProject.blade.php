@extends('layouts.app')

@section('projectSide')
  @include('partials.project_side', ['projects' => $user->projects])
@endsection
<section id="projectSide">
    @yield('projectSide')
</section>

<div id="projectUpdate">
<form method="POST" action = "{{route('project/edit', ['id' => $project->id])}}" id="userInf"> <!-- METER SLUG CORRETA -->
    @csrf
    <h4>Name</h4>
    <input id="projectNewName" type="text" name = "name" placeholder="{{ $project->name }}" autofocus>
    @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
    @endif
    <h4>Details</h4>
    <input id="projectNewDetails" type="text" name = "details" placeholder="{{ $project->details }}">
    @if($errors->has('details'))
        <div class="error">{{ $errors->first('details') }}</div>
    @endif
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>