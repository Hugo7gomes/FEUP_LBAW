<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Invite;
use App\Models\Project;
use App\Models\Notification;

class InviteController extends Controller
{
    public function create(int $project_id, Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $userReceiver = User::where('username',$request->get('usernameMember'))->first();
        if($userReceiver->banned()){
            $errors['message'] = "This user is banned";
            return $errors;
        }
        $project = Project::find($project_id);
        if(!isset($userReceiver) || $userReceiver->deleted){
            $errors['message'] = "User not found";
            return $errors;
        }
        if($project->is_member($userReceiver)){
            $errors['message'] = "User already collaborator";
            return $errors;
        }

        if($project->archived){
            $errors['message'] = "This project is archived";
            return $errors;
        }

        $invite = Invite::where('id_project',$project_id)->where('id_user_receiver',$userReceiver->id)->first();
        
        if(!isset($invite)){
            $invite = new Invite();
            $invite->state = 'Received';
            $invite->date = now();
            $invite->id_project = $project_id;
            $invite->id_user_sender = Auth::user()->id;
            $invite->id_user_receiver = $userReceiver->id;
            $user = User::find(Auth::user()->id);
            $this->authorize('create',$invite); 
            $invite->save();
        }elseif($invite->state == 'Received'){
            $errors['message'] = "User already invited";
            return $errors;
        }elseif($invite->state == 'Rejected'){
            $invite->state = 'Received';
            $invite->date = now();
            $invite->save();

            $notification = new Notification();
            $notification->date = now();
            $notification->id_project =$project_id;
            $notification->id_invite =$invite->id;
            $notification->id_comment = NULL;
            $notification->id_task =NULL;
            $notification->id_user = $userReceiver->id;
            $notification->type = 'Invite';
            $notification->save();
        }
        $errors['message'] = "User invite sent";        
        return $errors;

    }

    public function accept(Request $request){
        $invite = Invite::where('id_user_receiver',Auth::user()->id)->where('id_project',$request->get('id_project'))->first();
        if(!isset($invite)){
            //erro nao existe invite para adicionar este colaborador
            return redirect()->back();
        }

        $user = User::find(Auth::user()->id);
        $this->authorize('accept_reject', $invite);

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

        $project = Project::find($request->get('id_project'));

        return redirect("/project/$project->id");
        
    }

    public function reject(Request $request){
        $invite = Invite::where('id_user_receiver',Auth::user()->id)->where('id_project',$request->get('id_project'))->first();
        
        if(!isset($invite)){
            //erro nao existe invite para adicionar este colaborador
            return redirect()->back();
        }

        $user = User::find(Auth::user()->id);
        $this->authorize('accept_reject', $invite);

        $invite->state = 'Rejected';
        $invite->save();
        $notification = Notification::where('id_invite',$invite->id)->first();
        $notification->delete();
        
        return redirect()->back();
    }
}
