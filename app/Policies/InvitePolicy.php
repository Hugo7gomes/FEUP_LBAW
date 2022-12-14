<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invite;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitePolicy
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

    public function create(User $user, Invite $invite){
        $project = Project::find($invite->id_project); 
        if(is_null($project)){
            return false;
        }else{
            return $project->is_coordinator($user);
        }
    }

    public function accept_reject(User $user, Invite $invite){
        return $user->id == $invite->id_user_receiver;
    }
}
