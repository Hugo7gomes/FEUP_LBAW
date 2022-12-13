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
    public function create(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $userReceiver = User::where('username',$request->input('username'))->first();
        $project = Project::find($request->get('id'));
        if(!isset($userReceiver)){
            $errors['userNotFound'] = "User not found";
            return redirect()->back()->withInput()->withErrors($errors);
        }
        if($project->is_member($userReceiver)){
            $errors['userNotFound'] = "User already collaborator";
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $invite = Invite::where('id_project',$request->get("id"))->where('id_user_receiver',$userReceiver->id)->first();
        
        if(!isset($invite)){
            $invite = new Invite();
            $invite->state = 'Received';
            $invite->date = now();
            $invite->id_project = $request->get('id');
            $invite->id_user_sender = Auth::user()->id;
            $invite->id_user_receiver = $userReceiver->id;
            $user = User::find(Auth::user()->id);
            //$this->authorize('create',$invite); 
            $invite->save();
        }elseif($invite->state == 'Received'){
            $errors['userNotFound'] = "User already invited";
            return redirect()->back()->withInput()->withErrors($errors);
        }elseif($invite->state == 'Rejected'){
            $invite->state = 'Received';
            $invite->date = now();
            $invite->save();

            $notification = new Notification();
            $notification->date = now();
            $notification->id_project =$request->get("id");
            $notification->id_invite =$invite->id;
            $notification->id_comment = NULL;
            $notification->id_task =NULL;
            $notification->id_user = $userReceiver->id;
            $notification->type = 'Invite';
            $notification->save();
        }
        
        return redirect()->back();

    }

    public function accept(Request $request){
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


        return redirect()->back();
    }

    public function reject(Request $request){
        $invite = Invite::where('id_user_receiver',Auth::user()->id)->where('id_project',$request->get('id_project'))->first();
        
        if(!isset($invite)){
            //erro nao existe invite para adicionar este colaborador
            return redirect()->back();
        }
        $invite->state = 'Rejected';
        $invite->save();
        $notification = Notification::where('id_invite',$invite->id)->first();
        $notification->delete();
        
        return redirect()->back();
    }
}
