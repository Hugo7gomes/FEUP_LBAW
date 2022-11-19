<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function show(int $id){
        //policy para ver se ele pode ver este projeto
        if(!Auth::check()){
            return redirect("/home");
        }
        
        $project = Project::find($id);  
        $user = User::find(Auth::user()->id);

        $this->authorize('show',$project);


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

        
        
        $tasksToDo = array();
        $tasksDone = array();
        $tasksDoing = array();

        foreach($tasks as $task){
            if($task->state == 'To Do'){
                array_push($tasksToDo, $task);
            }elseif($task->state == 'Doing'){
                array_push($tasksDoing, $task);
            }elseif($task->state == 'Done'){
                array_push($tasksDone, $task);
            }
        }

        $notifications = $user->notifications;



        return view('pages.project',['notifications' => $notifications,'user' => $user,'tasksToDo' => $tasksToDo, 'tasksDoing' => $tasksDoing, 'tasksDone' => $tasksDone, 'project' => $project, 'coordinators' => $coordinators, 'collaborators' => $collaborators]);
    }


    //Testar create
    public function create(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $validator = Validator::make($request->all(),[
            'name' => 'min:5|string|max:255',
            'details' => 'min:5|string',
        ]);

        if($validator->fails()){
            foreach($validator->errors()->messages() as $key => $value){
                $errors[$key] = $value;
            }
            
            return redirect()->back()->withInput()->withErrors($errors);
        }


        $project = new Project();
        $project->name = $request->input('name');
        $project->details = $request->input('details');
        $project->creation_date = now();
        $project->id_creator = Auth::user()->id;
        $project->save();

        $project->becomeCoordinator(User::find(Auth::user()->id));

        return redirect("/project/$project->id");
    }

    public function showCreate(){
        if(!Auth::check()){
            return redirect("/home");
        }

        $user = User::find(Auth::user()->id);


        return view('pages.createProject', ['user' => $user]);
    }

    public function showUpdate(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }
        //só se for coordenador
        $project = Project::find($request->id);  

        $user = User::find(Auth::user()->id);
        $this->authorize('showUpdate', $project);
        
        return view('pages.editProject',['user' => $user, 'project'=>$project]); 
    }


    public function update(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $project = Project::find($request->get('id'));
        $user = User::find(Auth::user()->id);
        $this->authorize('update', $project);
        
        $validator = Validator::make($request->all(),[
            'name' => 'nullable|string|max:255',
            'details' => 'nullable|string',
        ]);

        if($validator->fails()){
            foreach($validator->errors()->messages() as $key => $value){
                $errors[$key] = $value;
            }
            
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $project->name = empty($request->get('name')) ? $project->name : $request->input('name');
        $project->details = empty($request->get('details')) ? $project->details : $request->input('details');
        $project->save();

        return redirect("/project/$project->id");

    }

    public function leave(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $project = Project::find($request->get('id'));
        $user = User::find(Auth::user()->id);
        $this->authorize('leave', $project);

        $user->leaveProject($project);

        return redirect("/profile");

    }

    public function search($query, $search)
    {
        if (!$search) {
            return $query;
        }
        return $query->whereRaw('tsvectors @@ to_tsquery(\'english\', ?)', [$search])
            ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$search]);
    }

}
