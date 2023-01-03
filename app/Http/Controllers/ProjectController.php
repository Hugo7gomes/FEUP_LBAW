<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Invite;
use App\Models\Role;
use App\Models\Task;
use App\Models\Favorite;

class ProjectController extends Controller
{


    public function show(int $id){
        if(!Auth::check()){
            return redirect("/home");
        }
        $project = Project::find($id);  
        $user = User::find(Auth::user()->id);

        $this->authorize('show',$project);
        
        if(!$project->archived){
            return view('pages.project',['user' => $user, 'project' => $project]);
        }else{
            return view('pages.archived.project',['user' => $user, 'project' => $project]);
        }
    }


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

    public function showUpdate(int $project_id){
        if(!Auth::check()){
            return redirect("/home");
        }
        
        $project = Project::find($project_id);  
        $user = User::find(Auth::user()->id);

        $this->authorize('showUpdate', $project);
        
        if(!$project->archived){
            return view('pages.editProject',['user' => $user,'project'=>$project]); 
        }else{
            return view('pages.archived.editProject',['user' => $user,'project'=>$project]); 
        }
        
    }


    public function update($project_id, Request $request){
        if(!Auth::check()){
            return redirect("/home");
        }

        $project = Project::find($project_id);
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

        return redirect("/project/$project->id/edit");

    }

    public function leave($project_id){
        if(!Auth::check()){
            return redirect("/home");
        }

        $project = Project::find($project_id);
        $user = User::find(Auth::user()->id);
        
        $this->authorize('leave', $project);

        $user->leaveProject($project);
        $favorite = Favorite::where([['id_user', Auth::user()->id],['id_project',$project_id]]);
        $favorite->delete();
        $invite = Invite::where('id_user_receiver',Auth::user()->id)->where('id_project',$project_id)->first();
        if($invite !== null){
            $invite->state = 'Rejected';
            $invite->save();
        }
        
        return redirect("/profile");

    }

    public function archive($project_id){
        if(!Auth::check()){
            return redirect("/home");
        }
        
        $project = Project::find($project_id);
        $user = User::find(Auth::user()->id);
        
        $this->authorize('archive', $project);

        $project->archived = TRUE;
        $project->save();
        return redirect("/project/$project->id");
    }

  
    public function showMembers(int $project_id){
        if(!Auth::check()){
            return redirect("/home");
        }
        $project = Project::find($project_id);  
        $user = User::find(Auth::user()->id);

        $this->authorize('show',$project);
        if(!$project->archived){
            return view('pages.teamMembers',['user' => $user, 'project' => $project]);
        }else{
            return view('pages.archived.teamMembers',['user' => $user, 'project' => $project]);
        }
        
    }

    public function removeMember(int $project_id, Request $request){
        $project = Project::find($project_id);
        $userToRemove = User::where('username',$request->get('username'))->first();
        
        $user = User::find(Auth::user()->id);
        $this->authorize('removeMember', $project);
        
        $userToRemove->leaveProject($project);
        $favorite = Favorite::where([['id_user', $userToRemove->id],['id_project',$project_id]]);
        $favorite->delete();
        $invite = Invite::where('id_user_receiver',$userToRemove->id)->where('id_project',$project_id)->first();
        if($invite !== null){
            $invite->state = 'Rejected';
            $invite->save();
        }

    }

    public function upgradeMember(int $project_id,Request $request){
        $project = Project::find($project_id);
        $userToUpgrade = User::where('username',$request->get('username'))->first();
        
        $user = User::find(Auth::user()->id);
        $this->authorize('upgradeMember', $project);
        
        DB::table('role')
        ->where([['id_project', $project->id],['id_user',$userToUpgrade->id]]) 
        ->update(array('role' => 'Coordinator')); 

        return Role::where([['id_user',$userToUpgrade->id],['id_project',$project->id]]);
    } 

    
    
}
