<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';

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

}
