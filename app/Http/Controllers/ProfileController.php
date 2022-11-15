<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Photo;
use App\Models\Projects;


class ProfileController extends Controller
{
    public function show(){

        $user = User::find(1);//em vez de 1 passar o id do user

        $projects = $user->projects;
        $photo = $user->photo;
        $notifications = $user->notifications;
        
        return view('pages.profile',['projects' => $projects, 'user' => $user, 'photo' => $photo]);
        //return response()->json($notifications);
    }
}
