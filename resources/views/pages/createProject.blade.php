@extends('layouts.app')

@section('createProject')

@section('content')

<link href="{{ asset('css/create_edit_proj_task.css') }}" rel="stylesheet">


<main>
<div id="createProject">
  <form method="POST" action = "{{ route('project/create') }}" class="createProjectForm">
  <h4>New Project</h4>
    @csrf
    <div class="form-group">
      <input type="text" name="name" class="form-control" id="projectName" placeholder="Name">
      @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
      @endif
    </div>
    <div class="form-group">
      <textarea type="text" name="details" class="form-control" id="projectDetails" placeholder="Details" rows = "3"></textarea>
      @if($errors->has('details'))
        <div class="error">{{ $errors->first('details') }}</div>
      @endif
    </div>
    <button type="submit" class="btn btn-outline-dark" id="createProjectButton">Create Project</button>
  </form>
</div>
<div>
  <div class="offcanvas offcanvas-end text-bg-dark show" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel" aria-modal="true" role="dialog">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">Trabalho de LBAW</h5>
          <button type="button" class="btn-close btn-close-white closeButton" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
          <h3 class="offcanvas-title" id="offcanvasNavbarDarkLabelTask">Página_projeto</h3>
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                  <div id="taskUpdate">
                      <form method="POST" action="http://localhost:8000/task/edit?id=5" class="editTaskForm">
                          <input type="hidden" name="_token" value="BTN9ngtTcoj53dNHxkh0KRUokWMKXC9MlVIbuV2d">                        <div class="form-group editTask">
                              <label for="taskName">Name</label>
                              <input type="text" name="name" class="form-control" id="taskNewName" placeholder="Página_projeto">
                                                      </div>
                          <div class="form-group editTask">
                              <label for="taskDetails">Details</label>
                              <textarea name="details" class="form-control" rows="3" id="taskNewDetails" placeholder="Página do projeto, esta página terá de constar os nomes dos participantes bem como as tasks de cada projeto"></textarea>
                                                      </div>
                          <div class="form_select editTask">
                          <label for="taskUser">User Assigned</label>
                              <select name="userAssigned" class="newUserAssigned custom-select">
                                  <option selected="">Lia Vieira</option>
                                                                      <option value="João Araújo" name="João Araújo">João Araújo</option>
                                                                      <option value="João Moreira" name="João Moreira">João Moreira</option>
                                                                                                      <option value="Hugo Gomes" name="Hugo Gomes">Hugo Gomes</option>
                                                                  User Assigned
                              </select>
                                                      </div>
                          <div class="form_select editTask">
                          <label for="taskPriority">Priority</label>
                              <select name="priority" class="optionsPriority custom-select">
                                  <option selected="">High</option>
                                  <option value="Low">Low</option>
                                  <option value="Medium">Medium</option>
                                  <option value="High">High</option>
                              </select>
                                                      </div>
                          <div class="form_select editTask">
                          <label for="taskState">State</label>
                              <select name="state" class="optionsState custom-select">
                                  <option selected="">To Do</option>
                                  <option value="To Do">To Do</option>
                                  <option value="Doing">Doing</option>
                                  <option value="Done">Done</option>
                              </select>
                                                      </div>
                          <button type="submit" class="btn btn-outline-light" id="updateTaskButton">Update Task</button>
                          <a href="http://localhost:8000/task/delete?id=5"><button class="btn btn-outline-danger" type="button" id="deleteTaskButton">Delete Task</button></a>
                      </form>
                  </div>
              </li>
              
                  <form method="Post" action="http://localhost:8000/task/5/comment/create" class="editTaskForm">
                      <input type="hidden" name="_token" value="BTN9ngtTcoj53dNHxkh0KRUokWMKXC9MlVIbuV2d">                    <div class="form-group editTask">
                          <label for="comment">Comment</label>
                          <textarea name="comment" class="form-control" rows="3" placeholder="Leave a comment"></textarea>
                      </div>
                      <button type="submit" class="btn btn-outline-light" id="commentButton">Comment</button>
                  </form>
          </ul>
      </div>
  </div>
</div>
</main>
@endsection