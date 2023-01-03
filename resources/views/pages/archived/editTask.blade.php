<!-- BOOTSTRAP SIDENAV -->
<div class="offcanvas offcanvas-end text-bg-dark show " tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel" aria-modal="true" role="dialog">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">{{ $project->name }}</h5>
        <button type="button" class="btn-close btn-close-white closeButton" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h3 class="offcanvas-title" id="offcanvasNavbarDarkLabelTask">{{ $task->name }}</h3>
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <div id="taskUpdate">
                    <div class="editTaskForm">
                        <div class="form-group editTask">
                            <label for="taskName">Name</label>
                            <div type="text" name="name" class="form-control" id="taskNewName" >{{ $task->name ?? 'Task Name' }}</div>
                            @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group editTask">
                            <label for="taskDetails">Details</label>
                            <div name="details" class="form-control" rows = "3" id="taskNewDetails">{{ $task->details ?? 'Task details'}}</div>
                            @if($errors->has('details'))
                            <div class="error">{{ $errors->first('details') }}</div>
                            @endif
                        </div>
                        <div class="form_select editTask">
                        <label for="taskUser">User Assigned</label>
                            <select name="userAssigned" class="newUserAssigned custom-select">
                                @if(!$userToAssign->banned())
                                    <option selected>{{ $userToAssign->name ?? 'User assigned' }}</option>
                                @else
                                    <option selected>Banned Account</option>
                                @endif
                            </select>
                            @if($errors->has('id_user_assigned'))
                            <div class="error">{{ $errors->first('id_user_assigned') }}</div>
                            @endif
                        </div>
                        <div class="form_select editTask">
                            <label for="taskPriority">Priority</label>
                            <select name="priority" class="optionsPriority custom-select">
                                <option selected>{{ $task->priority }}</option>
                            </select>
                            @if($errors->has('priority'))
                                <div class="error">{{ $errors->first('priority') }}</div>
                            @endif
                        </div>
                        <div class="form_select editTask">
                        <label for="taskState">State</label>
                            <select name="state" class="optionsState custom-select">
                                <option selected>{{ $task->state }}</option>
                            </select>
                            @if($errors->has('state'))
                                <div class="error">{{ $errors->first('state') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <section id = "sectionComments">
            @if (count($task->comments)>0)
                <div class="container my-5 py-5" id="commentContainer">
                    <div class="row d-flex justify-content-center">
                        <div class="card text-dark" id = "divComments">
                            <h4 class="mb-0">Comments</h4>
                            @foreach ($task->comments as $comment)
                            @if(!$comment->owner->banned())
                            <div class="card-body ">   
                                <div class="d-flex flex-start comment">
                                    @if($comment->owner->photo != null)
                                        <img src={{asset($comment->owner->photo->path)}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="60" height="60">
                                    @else
                                        <img src={{asset("avatars/default.png")}} alt="avatar" class="rounded-circle shadow-1-strong me-3" width="60" height="60">
                                    @endif
                                    <div class="commentInfo">
                                        <div class="commentText">
                                            <p class="commentName">{{$comment->owner->name}}</p>
                                            <p class="mb-0 commentDate">{{$comment->date}}</p>
                                        </div>
                                        <p class="mb-0 commentText">{{$comment->comment}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            </section>
        </ul>
    </div>
</div>