<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';

    public $timestamps  = false;

    /**
     * Project's tasks
     */

    public function coordinators(){
        return $this->hasMany('App\Models\Role','id_project')->where('role','Coordinator');
    }

    public function collaborators(){
        return $this->hasMany('App\Models\Role','id_project')->where('role','Collaborator');
    }

    public function is_unique_coordinator(User $user){
        return $this->is_coordinator($user) && (count($this->coordinators) == 1);
    }

    public function is_coordinator(User $user){
        return ($this->coordinators()->where('id_user',$user->id)->get()->isNotEmpty());
    }

    public function is_member(User $user){
        return ($this->hasMany('App\Models\Role','id_project')->where('id_user', $user->id)->get()->isNotEmpty());
    }

    public function is_favorite(User $user){
        return ($this->hasMany('App\Models\Favorite','id_project')->where('id_user', $user->id)->get()->isNotEmpty());
    }

    public function becomeCoordinator(User $user){
        DB::table('role')->insert(
            array(
                'role' => 'Coordinator',
                'id_user' => $user->id,
                'id_project' => $this->id
            )
        );
    }

    public function addCollaborator(User $user){
        DB::table('role')->insert(
            array(
                'role' => 'Collaborator',
                'id_user' => $user->id,
                'id_project' => $this->id
            )
        );
    }

    public function removeMember(User $user){
        DB::table('role')->where(
            array(
                'id_user' => $user->id,
                'id_project' => $this->id
            )
        )->delete();
    }

    private function order(String $priority){
        switch($priority){
            case "Low":
                return 0;
                break;
            case "Medium":
                return 1;
                break;
            case "High":
                return 2;
                break;
        }
    }

    public function tasks(){
        return Task::where('id_project', $this->id);
    }
    public function tasksToDo(){
        return Task::where('id_project', $this->id)->where('state', 'To Do')->simplePaginate(
            $perPage = 10, $columns = ['*'], $pageName = 'tasksToDo'
        );
    }

    public function tasksDoing(){
        return Task::where('id_project', $this->id )->where('state', 'Doing')->simplePaginate(
            $perPage = 10, $columns = ['*'], $pageName = 'tasksDoing'
        );
    }

    public function tasksDone(){
        return Task::where('id_project', $this->id)->where('state', 'Done')->simplePaginate(
            $perPage = 10, $columns = ['*'], $pageName = 'tasksDone'
        );
    }

    public function getCollaborators(){
        $collaboratorsIds = $this->collaborators()->get('id_user');
        
        $collaborators = array();//collaborators
        foreach ($collaboratorsIds as $collaboratorId){
            $collaborator = User::find($collaboratorId['id_user']);
            array_push($collaborators,$collaborator);
        }

        return $collaborators;
    }

    public function getCoordinators(){
        $coordinatorsIds = $this->coordinators()->get('id_user');//coordinator
       
     
       $coordinators = array();
       foreach ($coordinatorsIds as $coordinatorId){
           $coordinator = User::find($coordinatorId['id_user']);
           array_push($coordinators,$coordinator);
       }

       return $coordinators;
   }

    
}
