<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;


class TaskController extends Controller
{


    public function show(Request $request){
        //FALTA TESTAR
        if(!Auth::check()){
            return redirect("/home");
        }

        $task = Task::find($request->id);
        if(is_null($task)){
            return abort(404);
        }
        $user = User::find(Auth::user()->id);

        $this->authorize('show',$task);
        return response()->json('sim');
        return view('pages.editTask',['user'=>$user,'task'=>$task]);
    }

    public function create(Request $request){

        //FALTA TESTAR
        if(!Auth::check()){
            return redirect("/home");
        }
        

        $validator = Validator::make($request->all(),[
            'name' => 'min:4|string|max:255|required',
            'details' => 'nullable|string|max:255',
            'priority' => ['string','required',Rule::in(['Low','Medium', 'High'])],
            'id_user_assigned' => 'numeric',
        ]);

        if($validator->fails()){
            foreach($validator->errors()->messages() as $key => $value){
                $errors[$key] = $value;
            }
            
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $task = new Task();
        $task->name = $request->input('name');
        $task->state = 'To Do';
        $task->details = $request->input('details');
        $task->creation_date = now();
        $task->id_user_creator = Auth::user()->id;
        $userToAssign = User::where('name',$request->input('userAssigned'))->first();
        $project = Project::find($request->id);
        if (!isset($userToAssign)){
            $task->id_user_assigned = NULL;
        }else{
            if( !$project->is_member($userToAssign)){
                $errors['id_user_assigned'] = "User not collaborator";
                return redirect()->back()->withInput()->withErrors($errors);
            }
            $task->id_user_assigned = User::where('name',$request->input('userAssigned'))->first()->id;   
        }
        $task->priority = $request->input('priority');
        $task->id_project = $request->id;

        $user = User::find(Auth::user()->id);
        $this->authorize('create', $task);
        $task->save();

        return redirect("/project/$request->id");

    }


    public function update(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $task = Task::find($request->get('id'));
        $project = Project::find($task->id_project);

        $validator = Validator::make($request->all(),[
            'name' => 'nullable|min:4|string|max:255',
            'details' => 'nullable|string|max:255',
            'priority' => ['nullable','string',Rule::in(['Low','Medium', 'High'])],
            'id_user_assigned' => 'nullable|numeric',
            'state' => ['nullable','string',Rule::in(['To Do','Doing', 'Done'])],
        ]);

        if($validator->fails()){
            foreach($validator->errors()->messages() as $key => $value){
                $errors[$key] = $value;
            }
            
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $userToAssign = User::where('name',$request->input('userAssigned'))->first();

        if (!isset($userToAssign)){
            $id_userToAssing = NULL;
        }else{
            if(!$project->is_member($userToAssign)){
                $errors['id_user_assigned'] = "User not collaborator";
                return redirect()->back()->withInput()->withErrors($errors);
            };
            
            $id_userToAssing = $userToAssign->id;
        }
        
        $task->name = empty($request->get('name')) ? $task->name : $request->input('name');
        $task->details = empty($request->get('details')) ? $task->details : $request->input('details');
        $task->priority = empty($request->get('priority')) ? $task->priority : $request->input('priority');
        $task->id_user_assigned = $id_userToAssing;
        $task->state = empty($request->get('state')) ? $task->state : $request->input('state');
        //$this->authorize('update', $task);
        $task->save();

        return redirect("/project/$project->id");
    }


    public function showUpdate(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $task = Task::find($request->get('taskId'));
        if(is_null($task)){
            return abort(404);
        }
        $project = Project::find($request->get('projectId'));
        $user = User::find(Auth::user()->id);

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

        $userToAssign = User::find($task->id_user_assigned);


        return view('pages.editTask',['user'=>$user,'task'=>$task,'userToAssign' =>$userToAssign, 'coordinators' => $coordinators, 'collaborators' => $collaborators    ]);
    }

    public function delete(Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }
        $task = Task::find($request->get('id'));
        if(is_null($task)){
            return abort(404);
        }
        $user = User::find(Auth::user()->id);
        //$this->authorize('delete', $task);
        $task->delete();
        return redirect("/project/$task->id_project");

    }
}
