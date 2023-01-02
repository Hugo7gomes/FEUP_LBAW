<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function delete(Request $request){
        $notification = Notification::find($request->get('id'));
        $id = $notification->id;
        if(isset($notification)){
            $notification->delete();
        }

        return $notification;
    }
}
