<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user, User $model)
    {
      // Only a card owner can see it
      return $user->id == $model->id;
    }

    public function update(User $user, User $model)
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
