@extends('layouts.app')

@section('name', $user->name)

@section('content')

<link href="{{ asset('css/profile.css') }}" rel="stylesheet">

<main>
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center" id="profile">
            @if($user->photo != null)
            <img src={{asset($user->photo->path)}} alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
            @else
            <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
            @endif
              <form method="POST" action = "{{route('profile.avatar')}}" enctype="multipart/form-data">
                @csrf
                <div class='input-group input-group-sm'>
                  <input class="form-control" name = "avatar" type="file" accept="image/png, image/gif, image/jpeg" id='fileAvatar'>
                  <button class="btn btn-outline-secondary" type="submit" id='saveAvatar'><i class="bi bi-check"></i></button>
                </div>
              </form>
            <h5 class="my-3">{{ $user['name'] }}</h5>
            <p class="text-muted mb-1">{{ $user['email'] }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body" id="form">
            <div class="row">
            <form method="POST" action = "{{ route('profile') }}" id="userInf">
              @csrf
              <div class="form-group formsName">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Name</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "name" placeholder= "{{ $user['name'] }}" id="userName" class="form-control text-muted mb-0">
                  @if($errors->has('name'))
                  <div class="error">{{ $errors->first('name') }}</div>
                  @endif
                </div>
              </div>

              <div class="form-group formsUsername">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Username</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "username" placeholder= "{{ $user['username'] }}" id="userUsername" class="form-control text-muted mb-0">
                  @if($errors->has('username'))
                      <div class="error">{{ $errors->first('username') }}</div>
                  @endif
                </div>
              </div>

              <div class="form-group formsEmail">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Email</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "email" placeholder= "{{ $user['email'] }}" id="userEmail" class="form-control text-muted mb-0">
                  @if($errors->has('email'))
                      <div class="error">{{ $errors->first('email') }}</div>
                  @endif
                </div>
              </div>

              <div class="form-group formsPhone">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Phone Number</label>
                </div>
                <div class="col-sm-9">
                  <input type="tel" name = "phone_number" placeholder= "{{ $user['phone_number'] ?? 'No phoneNumber'}}" id="userPhone" class="form-control text-muted mb-0">
                  @if($errors->has('phone_number'))
                    <div class="error">{{ $errors->first('phone_number') }}</div>
                  @endif
                </div>
              </div>

              <div class="form-group formsPassword">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Password</label>
                </div>
                <div class="col-sm-9">
                  <input type="password" name = "password" placeholder= "User's password" id="password" class="form-control text-muted mb-0">
                  @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                  @endif
                </div>
              </div>

              <div class="form-group formsNewPassword">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">New Password</label>
                </div>
                <div class="col-sm-9">
                  <input type="password" name = "new_password" placeholder= "User's new password" id="new_password" class="form-control text-muted mb-0">
                  @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                  @endif
                </div>
              </div>
              <button type="submit" data-href="/profile/{{$user->username}}" class="btn btn-outline-dark btn-lg" id="updateProfileButton">Update</button>
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal" id="deleteAccountButton">Delete Account</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@if($user->is_only_coordinator())
<div class="modal " id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Danger - Deleting Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>
            You are the only coordinator at one or more projects. 
          </p>
        </div>
      </div>
    </div>
  </div>
@else
<div class="modal " id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Danger - Deleting Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>
            Are you sure you want to delete your account?
          </p>
        </div>
        <div class="modal-footer">
          <form method="POST" action = "{{route('profile.delete')}}" >
            @csrf
            <button type="submit" class="btn btn-outline-danger nav-link btn-block text-left" id="leaveProjectButton">Delete Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endif
</main>
@endsection

