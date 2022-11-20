<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\User;
use App\Models\Invite;
use App\Models\Role;
use App\Models\Notification;

class RoleController extends Controller
{
    public function create(Request $request){
        /*$role = new Role();
        $role->role = 'Collaborator';
        $role->id_user = Auth::user()->id;
        $role->id_project = $request->get('id_project');

       
        $role->save();*/

        

    }
}
