@section('notifications')       
<div class="dropdown">
          <div class = "dropdown-menu notifications container">
            @if(isset($notifications) && count($notifications)> 0)
              @foreach ($notifications as $notification)
              <div class="row">
                @if($notification->type != 'Invite')
                  <div class ="col" style="width: 18rem;" id = {{$notification->id}}>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <span class="text">{{$notification->text()}}</span>
                        <i class="deleteNot bi bi-x"></i>                        
                      </li>
                    </ul>
                  </div>
                @elseif($notification->type == 'Invite')
                <div class ="col" style="width: 18rem;" id = {{$notification->id}}>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <span class="text">{{$notification->text()}}</span>
                        <div class="buttonsInvite">
                          <form method = "POST" action ="{{ route('project/acceptInvite',['id_project' => $notification->id_project]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark acceptInviteButton">Accept</button>
                          </form>
                          <form method = "POST" action ="{{ route('project/rejectInvite',['id_project' => $notification->id_project]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark acceptInviteButton">Reject</button>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </div>
                @endif
                </div>
              @endforeach
            @else
                <div class ="col" style="width: 18rem;">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <span class="text">Notifications empty aqui</span>
                    </li>
                  </ul>
                </div>
            @endif
          </div>
        </div> 
@endsection