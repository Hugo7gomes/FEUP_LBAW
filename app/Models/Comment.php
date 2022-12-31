<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    public $timestamps  = false;

    /**
     * Get comment owner
     */

    public function owner(){
        return $this->belongsTo(User::class, 'id_user');
    }

    
}
