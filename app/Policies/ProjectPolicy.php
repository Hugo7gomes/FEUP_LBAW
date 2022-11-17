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

    public function showUpdate(User $user, Project $project){
      return true;
    }

    public function update(User $user, Project $project)
    {
      // Any user can list its own cards
      return $user->id == $model->id;
    }

    public function create(User $user)
    {
      // Any user can create a new profile
      return Auth::check();
    }

    public function delete(User $user, User $model)
    {
      // Only a profile owner can delete it
      return $user->id == $model->id;
    }
}
