<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';
    
    public $timestamps  = false;

    public function comments() {  
        return $this->hasMany('App\Models\Comment','id_task');
    }

    
    
}
