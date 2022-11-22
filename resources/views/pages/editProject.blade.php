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
<div class="teamMembers">
    <h3>Team Members</h3>
    @foreach ($coordinators as $coordinator)
    <div class="coordinator"><b><a href = "/profile/{{$coordinator['username']}}">{{$coordinator['username']}}</a></b></div>
    
    @endforeach
    @foreach ($collaborators as $collaborator)
    <div class="collaborator"><a href = "/profile/{{$collaborator['username']}}">{{$collaborator['username']}}</a></div>
    @endforeach
</div>