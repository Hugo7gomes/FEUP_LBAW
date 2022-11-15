<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function show($id){
        //policy para ver se ele pode ver este projeto
        $project = Project::find($id);
        $tasks = $project->tasks; //get tasks

        $coordinatorsIds = $project->coordinators()->get('id_user');//coordinator
        
        $collaboratorsIds = $project->collaborators()->get('id_user');
        
        $collaborators = array();//collaborators
        foreach ($collaboratorsIds as $collaboratorId){
            $collaborator = User::find($collaboratorId['id_user']);
            array_push($collaborators,$collaborator);
        }

        $coordinators = array();
        foreach ($coordinatorsIds as $coordinatorId){
            $coordinator = User::find($coordinatorId['id_user']);
            array_push($coordinators,$coordinator);
        }
        
        $user = User::find(1);
        //TODO
        //buscar comentarios de tasks
        //Separar tasks por State
        //


        //return response()->json($tasks->first());
        return view('pages.project',['user' => $user, 'tasks' => $tasks, 'project' => $project, 'coordinators' => $coordinators, 'collaborators' => $collaborators]);
    }
}
