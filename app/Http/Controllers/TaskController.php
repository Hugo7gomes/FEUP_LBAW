<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;


class TaskController extends Controller
{
    public function show($id){
        //FALTA TESTAR
        if(!Auth::check()){
            return redirect("/home");
        }

        $task = Task::find($id);
        $user = User::find(Auth::user()->id);

        $this->authorize('show',$task);

        return response()->json($task);
    }

    public function create(Request $request){

        //FALTA TESTAR
        if(!Auth::check()){
            return redirect("/home");
        }

        $validator = Validator::make($request->all(),[
            'name' => 'min:5|string|max:255|required',
            'state' => 'string|regex:(To Do|Doing|Done)|required',
            'details' => 'string|max:255',
            'priority' => 'string|regex:(High|Medium|Low)|required',
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
        $task->id_creator = Auth::user()->id;
        $task->id_user_assigned = $request->input('id_user_assigned');
        $task->priority = $request->input('priority');
        $task->save();

    }

    public function showCreate(){

    }

    public function update(Request $request){
        
    }


    public function showUpdate(){

    }
}
