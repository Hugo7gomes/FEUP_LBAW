<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';

    public function text(): string{
        if($this->type == 'Invite'){
            return (User::find($this->id_user)->name).'convidou-te para te juntares a'.(Project::find($this->id_project)->name);
        }elseif ($this->type == 'Comment'){
            return (User::find(Comment::find($this->id_comment)->id_user)->name).' comentou a task '. (Task::find($this->id_task)->name) .' do projeto '. (Project::find($this->id_project)->name);
        }elseif ($this->type == 'Assign'){
            return 'Foi-te atribuida a task "' . (Task::find($this->id_task)->name) . '" do projeto '. (Project::find($this->id_project)->name);
        }elseif ($this->type == 'TaskState'){
            return 'O estado da task "' . (Task::find($this->id_task)->name) . '" do projeto '. (Project::find($this->id_project)->name). ' foi atualizado ';
        }
    }
}
