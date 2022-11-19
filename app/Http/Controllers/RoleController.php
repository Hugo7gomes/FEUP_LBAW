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

        $invite = Invite::where('id_user_receiver',Auth::user()->id)->where('id_project',$request->get('id_project'))->first();
        if(!isset($invite)){
            //erro nao existe invite para adicionar este colaborador
            return redirect()->back();
        }

        $invite->state = 'Accepted';
        $invite->save();

        $notification = Notification::where('id_invite',$invite->id)->first();
        $notification->delete();

        DB::table('role')->insert(
            array(
                'role' => 'Collaborator',
                'id_user' => Auth::user()->id,
                'id_project' => $request->get('id_project'),
            )
        );


        return redirect("profile");

    }
}
