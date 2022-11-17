@extends('layouts.app')

<div id="profileCreate">
  <div id="userInfo">
    <form method="POST" action = "{{ route('project/create') }}" id="userInf">
      @csrf
      <h4>Name</h4>
      <input type="text" name = "name" placeholder= "Insert Project Name" id="projectName">
      @if($errors->has('name'))
          <div class="error">{{ $errors->first('name') }}</div>
      @endif
      <h4>Details</h4>
      <input type="text" name = "details" placeholder= "Insert Project Details" id="projectDetails">
      @if($errors->has('details'))
          <div class="error">{{ $errors->first('details') }}</div>
      @endif
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>