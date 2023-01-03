@extends('layouts.app')

@section('name', $userProfile->name)

@section('content')

<link href="{{ asset('css/othersProfile.css') }}" rel="stylesheet">

<main>
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body text-center" id="otherprofile">
            @if($userProfile->photo != null)
              <img src={{asset($userProfile->photo->path)}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="150px" height="150px">
            @else
              <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="150px" height="150px">
            @endif
            <h5 class="my-3">{{ $userProfile['name'] }}</h5>
            <p class="text-muted mb-1">{{ $userProfile['username'] }}</p>
            <p class="text-muted mb-1">{{ $userProfile['email'] }}</p>
            @if($user->administrator)
              @if(!$userProfile->administrator)  
                @if($userProfile->banned())
                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#unBanAccountModal" >Unban User</button>
                @else
                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#banAccountModal" >Ban User</button>
                @endif
              @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@if($user->administrator)
  @if($userProfile->banned())
  <div class="modal " id="unBanAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bannig Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action = "{{route('admin.unban', ['idToUnBan'=>$userProfile->id])}}" >
            @csrf
            <button type="submit" class="btn btn-outline-danger nav-link text-right">Unban Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="modal " id="banAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bannig Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action = "{{route('admin.ban', ['idToBan'=>$userProfile->id])}}" >
            @csrf
            <div class=" form-group">
              <label for="banDetails">Describe the ban's motive</label>
              <textarea name="banMotive" class="form-control" rows = "3" id="banDetails" placeholder="Ban motive"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-danger nav-link text-right">Ban Account</button>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  @endif
@endif
</main>

@endsection

