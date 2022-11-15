<article class="projectSide">
<header>
  <a href="#" class="delete">&#10761;</a>
</header>
<ul>
    @foreach ($projects as $project)
    <h3>{{ $project['name']}}</h3>
    @endforeach
</ul>
<button class="fa-solid fa-plus addProject"></button>
</article>