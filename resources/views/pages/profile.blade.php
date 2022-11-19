@extends('layouts.app')

<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container text-center" id="profileBoard">
  <div class="row">
    <div class="col-sm-9" id="userInfo">
      <div class="row">
      <div class="col-8 col-sm-6">
      </div>
    </div>
  </div>
</div>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ $user['name'] }}</h5>
            <p class="text-muted mb-1">{{ $user['email'] }}</p>
          </div>
        </div>
        <!-- <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            
          </div>
        </div> -->
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
            <form method="POST" action = "{{ route('profile') }}" id="userInf">
              @csrf
              <div class="formsName">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Name</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "name" placeholder= "{{ $user['name'] }}" id="userName" class="text-muted mb-0">
                  @if($errors->has('name'))
                  <div class="error">{{ $errors->first('name') }}</div>
                  @endif
                </div>
              </div>

              <div class="formsUsername">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Username</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "username" placeholder= "{{ $user['username'] }}" id="userUsername" class="text-muted mb-0">
                  @if($errors->has('username'))
                      <div class="error">{{ $errors->first('username') }}</div>
                  @endif
                </div>
              </div>

              <div class="formsEmail">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Email</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "email" placeholder= "{{ $user['email'] }}" id="userEmail" class="text-muted mb-0">
                  @if($errors->has('email'))
                      <div class="error">{{ $errors->first('email') }}</div>
                  @endif
                </div>
              </div>

              <div class="formsPhone">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Phone Number</label>
                </div>
                <div class="col-sm-9">
                  <input type="tel" name = "phone_number" placeholder= "{{ $user['phone_number'] ?? 'No phoneNumber'}}" id="userPhone" class="text-muted mb-0">
                  @if($errors->has('phone_number'))
                    <div class="error">{{ $errors->first('phone_number') }}</div>
                  @endif
                </div>
              </div>

              <div class="formsPassword">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Password</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "password" placeholder= "User's password" id="password" class="text-muted mb-0">
                  @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                  @endif
                </div>
              </div>

              <div class="formsNewPassword">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">New Password</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" name = "new_password" placeholder= "User's new password" id="new_password" class="text-muted mb-0">
                  @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                  @endif
                </div>
              </div>
              <button type="submit" data-href="/profile/{{$user->username}}" class="btn btn-outline-dark" id="updateProfileButton">Update</button>
            </form>
            </div>
            <hr>
            
            <div class="row">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-9">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
              <section id="userProjects">
                <h2>My projects</h2>
                <div class="userProjects">
                  @foreach ($projects as $project)
                  <h3>{{ $project['name']}}</h3>
                  @endforeach
                </div>
              </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
