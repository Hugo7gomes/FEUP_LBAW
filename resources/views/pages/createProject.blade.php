@extends('layouts.app')

@section('projectSide')
  @include('partials.project_side', ['projects' => $user->projects])
@endsection
<section id="projectSide">
    @yield('projectSide')
</section>

<div id="projectCreate">
  <form method="POST" action = "{{ route('project/create') }}" id="projectInf">
    @csrf
    <h4>Name</h4>
    <input type="text" name = "name" placeholder= "Project Name" id="projectName">
    @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
    @endif
    <h4>Details</h4>
    <input type="text" name = "details" placeholder= "Project Details" id="projectDetails">
    @if($errors->has('details'))
        <div class="error">{{ $errors->first('details') }}</div>
    @endif
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>