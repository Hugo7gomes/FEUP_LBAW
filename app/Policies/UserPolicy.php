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
      return $user->id == $model->id;
    }

    public function update(User $user, User $model)
    {
      return $user->id == $model->id;
    }

    public function create(User $user)
    {
      return Auth::check();
    }

    public function delete(User $user, User $model)
    {
      return false;
    }
}
