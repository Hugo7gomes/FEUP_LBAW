<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    public $timestamps  = false;

    /**
     * Get comment owner
     */

    public function owner(){
        $this->hasOne('App\Models\User','id_user');
    }

    
}
