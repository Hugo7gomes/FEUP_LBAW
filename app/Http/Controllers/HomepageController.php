<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomepageController extends Controller
{
    public function show(){
        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            if(!($user->favoriteProjects->isEmpty())){
                return redirect('/project/'.$user->favoriteProjects()->first()->id_project);
            }
            if(!($user->projects->isEmpty())){
                return redirect('/project/'.$user->projects()->first()->id);
            }

            return redirect('/project/create');

        }else{
            return view('pages.index');
        }
    }
}
