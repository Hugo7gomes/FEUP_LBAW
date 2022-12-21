<!-- BOOTSTRAP SIDENAV -->
<div class="offcanvas offcanvas-end text-bg-dark show" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel" aria-modal="true" role="dialog">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">{{ $project->name }}</h5>
        <button type="button" class="btn-close btn-close-white closeButton" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h3 class="offcanvas-title" id="offcanvasNavbarDarkLabelTask">{{ $task->name }}</h3>
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <div id="taskUpdate">
                    <form method="POST" action = "{{route('task/edit', ['id' => $task->id])}}" class="editTaskForm">
                        @csrf
                        <div class="form-group editTask">
                            <label for="taskName">Name</label>
                            <input type="text" name="name" class="form-control" id="taskNewName" placeholder="{{ $task->name ?? 'Task Name' }}">
                            @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group editTask">
                            <label for="taskDetails">Details</label>
                            <textarea name="details" class="form-control" rows = "3" id="taskNewDetails" placeholder="{{ $task->details ?? 'Task details'}}"></textarea>
                            @if($errors->has('details'))
                            <div class="error">{{ $errors->first('details') }}</div>
                            @endif
                        </div>
                        <div class="form_select editTask">
                        <label for="taskUser">User Assigned</label>
                            <select name="userAssigned" class="newUserAssigned custom-select">
                                <option selected>{{ $userToAssign->name ?? 'User assigned' }}</option>
                                @foreach ($project->getCoordinators() as $coordinator)
                                    <option value="{{ $coordinator['name']}}" name="{{ $coordinator['name']}}">{{ $coordinator['name']}}</option>
                                @endforeach
                                @foreach ($project->getCollaborators() as $collaborator)
                                    <option value="{{ $collaborator['name']}}" name="{{ $collaborator['name']}}">{{ $collaborator['name']}}</option>
                                @endforeach
                                <label for="floatingInput">User Assigned</label>
                            </select>
                            @if($errors->has('id_user_assigned'))
                            <div class="error">{{ $errors->first('id_user_assigned') }}</div>
                            @endif
                        </div>
                        <div class="form_select editTask">
                        <label for="taskPriority">Priority</label>
                            <select name="priority" class="optionsPriority custom-select">
                                <option selected>{{ $task->priority }}</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                            @if($errors->has('priority'))
                                <div class="error">{{ $errors->first('priority') }}</div>
                            @endif
                        </div>
                        <div class="form_select editTask">
                        <label for="taskState">State</label>
                            <select name="state" class="optionsState custom-select">
                                <option selected>{{ $task->state }}</option>
                                <option value="To Do">To Do</option>
                                <option value="Doing">Doing</option>
                                <option value="Done">Done</option>
                            </select>
                            @if($errors->has('state'))
                                <div class="error">{{ $errors->first('state') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-outline-light" id="updateTaskButton">Update Task</button>
                        <a href = "{{route('task/delete', ['id' => $task->id])}}"><button class="btn btn-outline-danger" type="button" id="deleteTaskButton">Delete Task</button></a>
                    </form>
                </div>
            </li>
            @if (count($task->comments)>0)
            <section>
                <div class="container my-5 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card text-dark">
                            <h4 class="mb-0">Comments</h4>
                            @foreach ($task->comments as $comment)
                            <div class="card-body p-4">   
                                <div class="d-flex flex-start">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp" alt="avatar" width="60"
                                        height="60" />
                                    <div>
                                        <h6 class="fw-bold mb-1"></h6>
                                        <div class="d-flex align-items-center mb-3">
                                        <p class="mb-0">{{$comment->date}}</p>
                                        </div>
                                        <p class="mb-0">{{$comment->comment}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

                <form method = "Post" action = "{{route('comment.create', ['task_id' => $task->id])}}" class="editTaskForm">
                    @csrf
                    <div class="form-group editTask">
                        <label for="comment">Comment</label>
                        <textarea name="comment" class="form-control" rows = "3" placeholder="Leave a comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-light" id="commentButton">Comment</button>
                </form>
        </ul>
    </div>
</div>