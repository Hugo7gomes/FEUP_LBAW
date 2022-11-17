<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Task $task)
    {
      // Only a collaborator from project task can see it
      return Project::find($task->id_project)->is_member($user) ;
    }

    public function task(User $user, Task $task)
    {
      // Only a collaborator from project task can see it
      return Project::find($task->id_project)->is_member($user) ;
    }
}
