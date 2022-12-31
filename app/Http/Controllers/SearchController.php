<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;


class SearchController extends Controller
{
    public function show(){
        $user = User::find(Auth::user()->id);
        return view('pages.search',['user'=> $user]);
    }

    public function search(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $searchText = $request->get('search');
        $project = Project::find($request->get('projectId'));

        $result = array();  
        $tasks = array();
        $projects = array();
        $users = array();
        if(isset($searchText)){
            $projects = $user->projects()->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', [$searchText])
            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', [$searchText])->get();

            $users = User::where([
                ['username', 'like' , '%'.$searchText.'%'],
                ['administrator', 'FALSE'],
            ])->get();
            
            $tasks = $project->tasks()->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', [$searchText])
            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', [$searchText])->get();
        }

        $result['projects'] = $projects;
        $result['users'] = $users;
        $result['tasks'] = $tasks;
        return json_encode($result);//Problema a retornar view 
        
    }
      
}
