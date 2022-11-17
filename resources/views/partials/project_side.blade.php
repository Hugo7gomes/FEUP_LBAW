<!-- <link href="{{ asset('css/project_side.css') }}" rel="stylesheet"> -->
<article class="projectSide">
<ul>
  @foreach ($projects as $project)
  <h3>{{ $project['name']}}</h3>
  @endforeach
</ul>
<button class="fa-solid fa-plus addProject" onclick="window.location='{{ route("project/create") }}'"></button>
</article>