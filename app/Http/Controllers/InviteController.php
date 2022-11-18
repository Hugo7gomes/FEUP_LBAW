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

        $invite = new Invite();
        $invite->state = 'Received';
        $invite->date = now();
        $invite->id_project = $request->get('id');
        $invite->id_user_sender = Auth::user()->id;
        $userToSend = User::where('username',$request->input('username'))->first();
        if(!isset($userToSend)){
            $errors['userNotFound'] = "User not found";
            return redirect()->back()->withInput()->withErrors($errors);
        }


        $invite->id_user_receiver = $userToSend->id;
        
        $user = User::find(Auth::user()->id);
        //Convidar se for coordenador o convidado não pode ser membro e nao ter recebido um invite
        $this->authorize('create',$invite);
        $invite->save();

        return redirect('project/$request->get("id")');

    }
}
