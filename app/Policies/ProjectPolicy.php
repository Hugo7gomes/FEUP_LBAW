<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Project $project)
    {
      // Only a card owner can see it
      return $project->is_member($user);
    }

    public function update(User $user, Project $project)
    {
      return $project->is_coordinator($user) && !$project->archived;
    }

    public function removeMember(User $user, Project $project){
      return $project->is_coordinator($user) && !$project->archived;
    } 

    public function upgradeMember(User $user, Project $project){
      return $project->is_coordinator($user) && !$project->archived;
    }

    public function leave(User $user, Project $project){
      return $project->is_member($user) && !$project->is_unique_coordinator($user) && !$project->archived;
    }

    public function archive(User $user, Project $project){
      return $project->is_coordinator($user);
    }
}
