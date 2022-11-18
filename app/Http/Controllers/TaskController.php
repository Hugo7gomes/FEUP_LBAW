<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

        return view('pages.task',['user'=>$user,'task'=>$task]);
    }

    public function create(Request $request){

        //FALTA TESTAR
        if(!Auth::check()){
            return redirect("/home");
        }
        

        $validator = Validator::make($request->all(),[
            'name' => 'min:5|string|max:255|required',
            'details' => 'nullable|string|max:255',
            'priority' => 'string|required',
            'id_user_assigned' => 'numeric|unique:users',
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
        if (is_null(User::where('name',$request->userAssigned)->first())){
            $task->id_user_assigned = NULL;
        }else{
            $task->id_user_assigned = User::where('name',$request->userAssigned)->first()->id;   
        }
        $task->priority = $request->input('priority');
        $task->id_project = $request->id;

        $user = User::find(Auth::user()->id);
        $this->authorize('create', $task);
        $task->save();

        return redirect("/project/$request->id");

    }

    public function showCreate(){

    }

    public function update(Request $request){
        
    }


    public function showUpdate(){

    }
}
