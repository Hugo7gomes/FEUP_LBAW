@extends('layouts.app')

@section('name', $user->name)

@section('content')

<link href="{{ asset('css/othersProfile.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<main>
<div class="container text-center" id="othersProfileBoard">
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
          <div class="card-body text-center" id="otherprofile">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ $user['name'] }}</h5>
            <p class="text-muted mb-1">{{ $user['email'] }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body" id="info">
            <div class="row">
                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Name</label>
                </div>
                <div class="col-sm-9">
                    <text id="userName" class="text-muted mb-0">{{ $user['name'] }}</text>
                </div>

                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Username</label>
                </div>
                <div class="col-sm-9">
                    <text id="userName" class="text-muted mb-0">{{ $user['username'] }}</text>
                </div>

                <div class="col-sm-3">
                  <label for="exampleFormControlInput1" class="mb-0">Email</label>
                </div>
                <div class="col-sm-9">
                    <text id="userName" class="text-muted mb-0">{{ $user['email'] }}</text>
                </div>
            </div>
            
            <div class="row">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-9">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4 mb-md-0">
              <div class="card-body" id="projects">
              <section id="usersProjects">
                <h3><b>{{ $user['name']}}</b>  's projects</h3>
                <div class="userProjects">
                @foreach ($projects as $project)
                    <div class="item">
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <div id="projectPhoto">{{ strtok($project->name, ' ') }}</div>
                        </div>
                    </div>
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
</main>

@endsection

