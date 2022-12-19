<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;


class SearchController extends Controller
{
    public function show(){
        $user = User::find(Auth::user()->id);
        return view('pages.search',['user'=> $user]);
    }

    public function search(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $searchText = $request->input('search');

        $taskIds = Task::select('id')
        ->join('role', 'task.id_project', '=', 'role.id_project')
        ->where('id_user', $user->id)
        ->get();
        
        $tasksFirst = array();
        foreach ($taskIds as $taskId){
            $task = Task::find($taskId)->first();
            array_push($tasksFirst,$task);
        }

        $result = array();  
        $tasks = array();
        $projects = array();
        if(isset($searchText)){
            $projects = $user->projects()->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', [$searchText])
            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', [$searchText])->limit(5)->get();

            /*$tasks = $tasksFirst->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', [$searchText])
            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\', ?)) DESC', [$searchText])
            ->limit(5)->get();*/
        }

        
        return response()->json($projects);//Problema a retornar view 
        
    }
      
}
