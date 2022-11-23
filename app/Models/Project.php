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
    public function tasks() {  
        return $this->hasMany('App\Models\Task', 'id_project');
    }

    public function coordinators(){
        return $this->hasMany('App\Models\Role','id_project')->where('role','Coordinator');
    }

    public function collaborators(){
        return $this->hasMany('App\Models\Role','id_project')->where('role','Collaborator');
    }

    public function is_coordinator(User $user){
        return ($this->coordinators()->where('id_user',$user->id)->get()->isNotEmpty());
    }

    public function is_member(User $user){
        return ($this->hasMany('App\Models\Role','id_project')->where('id_user', $user->id)->get()->isNotEmpty());
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

    
}
