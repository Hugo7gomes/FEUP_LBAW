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
      $project = Project::find($task->id_project); 
      if(is_null($project)){
        return false;
      }else{
        return $project->is_member($user) || $user->administrator;
      }
    }

    public function create_update_delete(User $user, Task $task)
    {
      // Only a collaborator from project task can see it
      $project = Project::find($task->id_project); 
      if(is_null($project)){
        return false;
      }else{
        return ($project->is_member($user) && !$project->archived) || $user->administrator;
      }
    }

}
