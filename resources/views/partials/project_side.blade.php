<link href="{{ asset('css/project_side.css') }}" rel="stylesheet">
<!-- <article class="l-navbar projectSide">
  <div><i class='bx bx-layer nav_logo-icon'></i>
    <ul class="nav flex-column">
      @foreach ($projects as $project)
      <li class="nav_logo">
        <div class="nav_list"><a class="nav-link active" aria-current="page" href="#">{{ $project['name']}}</a></div>
      </li>
      @endforeach
    </ul>
  </div>
<a><button class="fa-solid fa-plus addProject" onclick="window.location='{{ route("project/create") }}'">Add Project</button></a>
</article> -->


<div class="l-navbar" id="nav-bar">
  <nav class="nav">
    <div class="nav_list"> 
      @foreach ($projects as $project)
      <a href="#" class="nav_link"> 
        <span class="nav_name">{{ $project['name']}}</span> 
      </a> 
      @endforeach
    </div> 
    <a><button class="fa-solid fa-plus addProject" onclick="window.location='{{ route("project/create") }}'">Add Project</button></a>
  </nav>
</div>
