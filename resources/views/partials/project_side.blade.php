<link href="{{ asset('css/project_side.css') }}" rel="stylesheet">

@section('project_side')
  <nav class="navbar-fixed-left d-block bg-white" style="width: 350px;">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#favoriteProjects-collapse" aria-expanded="true">
          Favorite Projects
        </button>
        <a href='{{ route("project/create") }}' class="btn btn-toggle align-items-center rounded collapsed btn-secondary" aria-expanded="true">
          New
        </a>
        <div class="collapse show" id="favoriteProjects-collapse">
          <ul class=" nav-pills btn-toggle-nav list-unstyled fw-normal pb-1 large">
            @foreach ($user->favoriteProjects as $projectFavorite)
              <li><a href="{{url('project/'.$projectFavorite->id_project)}}" class="nav-link link-dark rounded font-weight-bold">{{$projectFavorite->id_project}}</a></li>
            @endforeach
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      @if(Request::is('*/edit'))
      <ul class = "nav nav-pills flex-sm-column mb-auto ">
          <li class = "nav-item">
            <a href = "{{url('project/'.$project->id)}}" class="nav-link link-dark" id="boardProjectButton">Board</a>
          </li>
          <li class = "nav-item">
            <a href = "{{route('project.editShow', ['project_id' => $project->id])}}" class="nav-link active" id="teamMembersProjectButton">General Settings</a>
          </li>
          <li class = "nav-item">
            <a  href = "{{route('project.members', ['project_id' => $project->id])}}" class="nav-link link-dark " id="teamMembersProjectButton">Project Members</a>
          </li>
          <li class = "nav-item">
            <form method="POST" action = "{{ route('project.leave', ['project_id' => $project->id]) }}" >
              @csrf
              <button type="submit" class="btn btn-outline-danger nav-link btn-block text-left" id="leaveProjectButton">Leave Project</button>
            </form>
          <li>
      </ul>
      @elseif (Request::is('*/members'))
      <ul class = "nav nav-pills flex-sm-column mb-auto ">
          <li class = "nav-item">
            <a href = "{{url('project/'.$project->id)}}" class="nav-link link-dark" id="boardProjectButton">Board</a>
          </li>
          <li class = "nav-item">
            <a href = "{{route('project.editShow', ['project_id' => $project->id])}}" class="nav-link link-dark" id="teamMembersProjectButton">General Settings</a>
          </li>
          <li class = "nav-item">
            <a  href = "{{route('project.members', ['project_id' => $project->id])}}" class="nav-link active " id="teamMembersProjectButton">Project Members</a>
          </li>
          <li class = "nav-item">
            <form method="POST" action = "{{ route('project.leave', ['project_id' => $project->id]) }}" >
              @csrf
              <button type="submit" class="btn btn-outline-danger nav-link btn-block text-left" id="leaveProjectButton">Leave Project</button>
            </form>
          <li>
      </ul>
      @elseif (Request::is('project/*'))
      <ul class = "nav nav-pills flex-sm-column mb-auto ">
          <li class = "nav-item">
            <a href = "{{url('project/'.$project->id)}}" class="nav-link active" id="boardProjectButton">Board</a>
          </li>
          <li class = "nav-item">
          <a href = "{{route('project.editShow', ['project_id' => $project->id])}}" class="nav-link link-dark" id="teamMembersProjectButton">General Settings</a>
          </li>
          <li class = "nav-item">
            <a  href = "{{route('project.members', ['project_id' => $project->id])}}" class="nav-link link-dark " id="teamMembersProjectButton">Project Members</a>
          </li>
          <li class = "nav-item">
            <form method="POST" action = "{{ route('project.leave', ['project_id' => $project->id]) }}" >
              @csrf
              <button type="submit" class="btn btn-outline-danger nav-link btn-block text-left" id="leaveProjectButton">Leave Project</button>
            </form>
          <li>
      </ul>
      @endif
    </ul>
  </nav>
@endsection
