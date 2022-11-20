<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Project;


class FavoriteController extends Controller
{
    public function create(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }
        $project = Project::find($request->get('id'))->first();
        if(!isset($project) || !$project->is_member(User::find(Auth::user()->id)->first())){
            return redirect('/project/{$request->get("id")}');
        }
        DB::table('favorite_proj')->insert(
            array(
                'id_user' => Auth::user()->id,
                'id_project' => $request->get('id'),
            )
        );
        


        return redirect('/project/{$request->get("id")}');
    }

    public function delete(Request $request){
        
    }
}
