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
    public function create(int $project_id){
        if(!Auth::check()){
            return redirect("/home");
        }
        $project = Project::find($project_id);
        $user = User::find(Auth::user()->id);
        if(!isset($project) || !$project->is_member($user)){
            return json_encode(null);
        }
        DB::table('favorite_proj')->insert(
            array(
                'id_user' => Auth::user()->id,
                'id_project' => $project_id,
            )
        );
        return json_encode($project);
    }

    public function delete(int $project_id){
        if(!Auth::check()){
            return redirect("/home");
        }
        $project = Project::find($project_id);
        $user = User::find(Auth::user()->id);
        if(!isset($project) || !$project->is_member($user)){
            return json_encode(null);
        }

        DB::table('favorite_proj')->where(
            array(
                'id_user' => Auth::user()->id,
                'id_project' => $project_id,
            )
        )->delete();

        return json_encode($project);
        
    }
}
