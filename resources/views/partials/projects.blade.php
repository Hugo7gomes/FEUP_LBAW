@if (count($projects) > 0)
    @foreach $projects as $project
        <span>Aqui</span>
    @endforeach
@else
  <h6 class="text-muted">No projects found!</h6>
@endif