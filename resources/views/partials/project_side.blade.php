<link href="{{ asset('css/project_side.css') }}" rel="stylesheet">
<script src={{ asset('js/sideNav.js') }} defer></script>
@section('project_side')
  <nav class="navbar-fixed-left d-block bg-white">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
          <button id="favoriteProjectsTitle" class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#favoriteProjects-collapse" aria-expanded="true">
          <i class="bi bi-chevron-down"></i><span class="">Favorite Projects</span>
          </button>
          @if(!$user->administrator)
          <a href='{{ route("project/create") }}' id="newProject" class="btn btn-toggle align-items-center rounded collapsed btn-secondary" aria-expanded="true">
            New
          </a>
          @endif
        <div class="collapse show" id="favoriteProjects-collapse">
          <ul class=" favoriteProjects nav-pills btn-toggle-nav list-unstyled fw-normal pb-1 large">
            @foreach ($user->favoriteProjects() as $projectFavorite)
              <li id = "proj{{$projectFavorite->id}}" ><a href="{{url('project/'.$projectFavorite->id)}}" class="nav-link link-dark rounded font-weight-bold">{{$projectFavorite->name}}</a></li>
            @endforeach
          </ul>
        </div>
      </li>
      <li class="border-top my-3">
      <ul class = "nav nav-pills flex-sm-column mb-auto ">
          <li class = "nav-item">
            <a href = "{{url('project/'.$project->id)}}" class="nav-link link-dark" id="boardProjectButton">Board</a>
          </li>
          @if($project->is_coordinator($user))
          <li class = "nav-item">
            <a href = "{{route('project.editShow', ['project_id' => $project->id])}}" class="nav-link link-dark" id="editProjectButton">General Settings</a>
          </li>
          @endif
          <li class = "nav-item">
            <a  href = "{{route('project.members', ['project_id' => $project->id])}}" class="nav-link link-dark " id="teamMembersProjectButton">Project Members</a>
          </li>
          @if(!$project->archived)
            <li class = "nav-item">
              <button type="button" class="btn btn-outline-danger nav-link btn-block text-left" data-bs-toggle="modal" data-bs-target="#leaveModal" id="leaveProjectButton">Leave Project</button>
            </li>
            @if($project->is_coordinator($user))
            <li class = "nav-item">
              <button type="button" class="btn btn-outline-danger nav-link btn-block text-left" data-bs-toggle="modal" data-bs-target="#archiveModal" id="leaveProjectButton">Archive Project</button>
            </li>
            @endif
          @endif
      </ul>
      </li>
    </ul>
  </nav>
  @if(!$project->archived)
  @if($project->is_unique_coordinator($user))
  <div class="modal " id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Danger - Leaving project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>You are the only coordinator so you cannot leave the project</p>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="modal " id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Danger - Leaving project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to leave the project?</p>
        </div>
        <div class="modal-footer">
          <form method="POST" action = "{{ route('project.leave', ['project_id' => $project->id]) }}" >
            @csrf
            <button type="submit" class="btn btn-outline-danger nav-link btn-block text-left" id="leaveProjectButton">Leave Project</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
  @if($project->is_coordinator($user))
  <div class="modal " id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Danger - Archive Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>This project will become read-only</p>
        </div>
        <div class="modal-footer">
          <form method="POST" action = "{{ route('project.archive', ['project_id' => $project->id]) }}" >
            @csrf
            <button type="submit" class="btn btn-outline-danger nav-link btn-block text-left" id="archiveProjectButton">Archive Project</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endif
@endsection
