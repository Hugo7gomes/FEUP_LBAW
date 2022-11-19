<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Invite;

class InviteController extends Controller
{
    public function create(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $userReceiver = User::where('username',$request->input('username'))->first();
        if(!isset($userReceiver)){
            $errors['userNotFound'] = "User not found";
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
            $notification->save();
        }

        return redirect()->back();

        
       



    
        
        
        //Convidar se for coordenador o convidado não pode ser membro e nao ter recebido um invite


    }
}
